<?php namespace Poppy\System\Http\Middlewares;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\AuthenticateSession as BaseAuthenticateSession;
use Tymon\JWTAuth\JWTGuard;

/**
 * User Session Auth Validation
 * If User Password Changed, Other User In Session are logout
 * 注意项目 :
 * 1. 用户登录成功之后需要触发重新计算 password_hash, 如果不清空则二次登录的时候会自动再次退出一次
 * 2. 此中间件需要放置在 auth:xx 之后
 */
class AuthenticateSession extends BaseAuthenticateSession
{

    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        /* Jwt 不进行 Session 权限校验
         * ---------------------------------------- */
        if ($this->auth->guard() instanceof JWTGuard) {
            return $next($request);
        }

        if (!$request->user() || !$request->session()) {
            return $next($request);
        }

        if ($this->auth->viaRemember()) {
            $passwordHash = explode('|', $request->cookies->get($this->auth->getRecallerName()))[2];
            if ($passwordHash != $request->user()->getAuthPassword()) {
                $this->logout($request);
            }
        }
        $loginSessionKey = $this->auth->guard()->getName();
        $hashKey         = self::hashKey($loginSessionKey);

        if (!$request->session()->has($hashKey)) {
            $this->storePasswordHashInSession($request);
        }

        if ($request->session()->get($hashKey) !== $request->user()->getAuthPassword()) {
            $this->logout($request);
        }

        return tap($next($request), function () use ($request) {
            $this->storePasswordHashInSession($request);
        });
    }

    /**
     * Store the user's current password hash in the session.
     * @param Request $request
     * @return void
     */
    protected function storePasswordHashInSession($request)
    {
        if (!$request->user()) {
            return;
        }

        $loginSessionKey = $this->auth->guard()->getName();

        $request->session()->put([
            self::hashKey($loginSessionKey) => $request->user()->getAuthPassword(),
        ]);
    }


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function logout($request)
    {
        $this->auth->logoutCurrentDevice();

        $request->session()->flush();

        $loginSessionKey = $this->auth->guard()->getName();
        $guards          = [self::guardName($loginSessionKey)];
        throw new AuthenticationException('无权访问', $guards, Authenticate::detectLocation($guards));
    }

    /**
     * Password hash key
     * @param string $login_key login key
     * @return string
     */
    public static function hashKey($login_key)
    {
        $guard = self::guardName($login_key);
        return 'password_hash' . ($guard ? '_' . $guard : '');
    }

    private static function guardName($login_key)
    {
        $guard = '';
        if (preg_match('/login_(?<guard>.*?)_/', $login_key, $match)) {
            $guard = $match['guard'];
        }
        return $guard;
    }
}