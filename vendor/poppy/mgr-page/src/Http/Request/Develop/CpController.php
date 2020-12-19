<?php namespace Poppy\MgrPage\Http\Request\Develop;

use Carbon\Carbon;
use Curl\Curl;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\CookieHelper;
use Poppy\System\Classes\Contracts\ApiSignContract;
use Session;
use Throwable;

/**
 * 开发平台控制台 cp = ControlPanel
 */
class CpController extends DevelopController
{
    /**
     * 开发者控制台
     * @return View
     */
    public function index()
    {
        return view('py-mgr-page::develop.cp.cp');
    }

    /**
     * 接口调试平台
     * @return Factory|View
     */
    public function api()
    {
        $this->seo('接口调试平台');
        $tokenGet = function ($cookie_key) {
            if (CookieHelper::has($cookie_key)) {
                $token = CookieHelper::get($cookie_key);

                // check token is valid
                $curl   = new Curl();
                $access = route('py-system:pam.auth.access');
                $curl->setHeader('x-requested-with', 'XMLHttpRequest');
                $curl->setHeader('Authorization', 'Bearer ' . $token);
                $curl->setHeader('X-ACCESS-TOKEN', $token);
                $curl->post($access);
                if ($curl->httpStatusCode === 401) {
                    CookieHelper::remove($cookie_key);
                }
            }

            return CookieHelper::get($cookie_key);
        };

        return view('py-mgr-page::develop.cp.api', [
            'token_default' => $tokenGet('dev_token#default'),
            'token_web'     => $tokenGet('dev_token#web'),
            'token_backend' => $tokenGet('dev_token#backend'),
            'url_system'    => route('py-mgr-page:develop.cp.doc', 'system'),
            'url_poppy'     => route('py-mgr-page:develop.cp.doc', 'poppy'),
        ]);
    }

    /**
     * api 登录
     * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
     */
    public function apiLogin()
    {
        $type = input('type');
        if (is_post()) {
            $access = route('py-system:pam.auth.token', [$type]);
            try {
                $Curl = new Curl();
            } catch (Throwable $e) {
                return Resp::error($e->getMessage());
            }

            /** @var ApiSignContract $sign */
            $sign   = app(ApiSignContract::class);
            $param  = [
                'passport'  => input('passport'),
                'password'  => input('password'),
                'timestamp' => Carbon::now()->timestamp,
            ];
            $strSig = $sign->sign($param);

            $data = $Curl->post($access, $param + [
                    'sign' => $strSig,
                ]);
            if ($Curl->httpStatusCode === 200) {
                if ((int) $data->status === Resp::SUCCESS) {
                    $token = 'dev_token#' . $type;
                    Session::put($token, data_get($data, 'data.token'));
                }
                else {
                    return Resp::error($data->message);
                }

                return Resp::success('登录成功', '_top_reload|1');
            }

            return Resp::error($Curl->errorMessage);
        }

        return view('py-mgr-page::develop.cp.api_login', compact('type'));
    }

    /**
     * token
     * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
     */
    public function setToken()
    {
        $type     = input('type');
        $tokenKey = 'dev_token#' . $type;
        if (is_post()) {
            $token = input('token');
            if (!$token) {
                return Resp::error('token 不存在');
            }
            Session::remove($tokenKey);
            Session::put($tokenKey, $token);

            return Resp::success('设置 token 成功', '_top_reload|1');
        }
        $token = Session::get($tokenKey);

        return view('py-mgr-page::develop.cp.set_token', compact('type', 'token'));
    }

    /**
     * 文档地址
     * @param null $type 文档类型
     * @return RedirectResponse|Redirector
     */
    public function doc($type = null)
    {
        $type = $type ?: 'system';

        return redirect(url('docs/' . $type));
    }
}
