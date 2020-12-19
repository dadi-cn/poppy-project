<?php namespace Poppy\System\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\EnvHelper;
use Poppy\Framework\Http\Middlewares\EnableCrossRequest as PoppyEnableCrossRequest;

/**
 * 添加跨域登录的限制
 */
class EnableCrossRequest extends PoppyEnableCrossRequest
{

    /**
     * Middleware handler.
     * @param Request $request request
     * @param Closure $next    next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $origin = config('poppy.system.enable_cross.origin');
        if (!$origin) {
            $origin = '*';
        }
        if (is_array($origin)) {
            $schema    = EnvHelper::scheme();
            $domain    = EnvHelper::domain();
            $reqDomain = "{$schema}://{$domain}";
            if (in_array($reqDomain, $origin)) {
                $origin = $reqDomain;
            }
            else {
                return Resp::error('跨域访问, 访问受限');
            }
        }
        $header  = config('poppy.system.enable_cross.headers');
        $headers = collect([
            'Access-Control-Allow-Origin'      => $origin,
            'Access-Control-Allow-Headers'     => 'Origin,Content-Type,Cookie,Accept,Authorization,X-Requested-With' . ($header ? ',' . $header : ''),
            'Access-Control-Allow-Methods'     => 'DELETE,GET,POST,PATCH,PUT,OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
        ]);

        return $this->respWithHeaders($headers, $request, $next);
    }
}