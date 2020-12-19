<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Auth;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\Framework\Helper\EnvHelper;
use Poppy\Framework\Helper\StrHelper;
use Poppy\System\Action\Pam;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Forms\Backend\FormPassword;
use Poppy\System\Models\PamAccount;
use Throwable;

/**
 * 主页控制器
 */
class HomeController extends BackendController
{
    use PoppyTrait;

    /**
     * 主页
     * @return View
     */
    public function index()
    {
        $host = StrHelper::formatId(EnvHelper::host()) . '-backend';
        return view('py-mgr-page::backend.home.index', [
            'host' => $host,
        ]);
    }

    /**
     * 登录
     */
    public function login()
    {
        $auth     = $this->auth();
        $username = (string) input('username');
        $password = (string) input('password');
        if (is_post()) {
            $Pam = new Pam();
            if ($Pam->loginCheck($username, $password, PamAccount::GUARD_BACKEND)) {
                $auth->login($Pam->getPam(), true);
                return Resp::success('登录成功', '_location|' . route('py-mgr-page:backend.home.index'));
            }
            return Resp::error($Pam->getError());
        }

        if ($auth->check()) {
            return Resp::success('登录成功', '_location|' . route('py-mgr-page:backend.home.index'));
        }

        return view('py-mgr-page::backend.home.login');
    }

    /**
     * 修改本账户密码
     * todo
     */
    public function password()
    {

        $form = new FormPassword();
        $form->setPam($this->pam());
        return (new Content())->body($form);
        return view('py-mgr-page::backend.home.password');
    }

    public function clearCache()
    {
        sys_cache('py-core')->clear();
        sys_cache('py-system')->clear();
        $this->pyConsole()->call('poppy:optimize');
        return Resp::success('已清空缓存');
    }

    /**
     * 后台前端帮助文件
     * @param $param
     * @return array|Factory|JsonResponse|RedirectResponse|Response|Redirector|View
     */
    public function fe($param = null)
    {
        if ($param) {
            if (is_post()) {
                return Resp::success('提交信息成功', '_top_reload|1');
            }

            return view('py-mgr-page::backend.home.fe-' . $param);
        }
        try {
            $random = random_int(0, 9999);
        } catch (Exception $e) {
            $random = 0;
        }

        return view('py-mgr-page::backend.home.fe', compact('random'));
    }

    /**
     * 登出
     * @return RedirectResponse|Redirector
     */
    public function logout()
    {
        Auth::guard(PamAccount::GUARD_BACKEND)->logout();

        return Resp::success('退出登录', '_location|' . route('py-mgr-page:backend.home.login'));
    }

    /**
     * 控制面板
     * @return View
     */
    public function cp()
    {
        return view('py-mgr-page::backend.home.cp');
    }

    /**
     * Setting
     * @param string $path 地址
     * @param int    $index
     * @return mixed
     */
    public function setting($path = 'poppy.system', $index = 0)
    {
        try {
            $index = (int) $index;
            $hooks = sys_hook('poppy.system.settings');
            $forms = collect($hooks[$path]['forms'])->map(function ($form) {
                return app($form);
            });
            return view('py-mgr-page::backend.tpl.settings', [
                'hooks' => $hooks,
                'forms' => $forms,
                'index' => $index,
                'cur'   => $forms->offsetGet($index),
                'path'  => $path,
            ]);
        } catch (Throwable $e) {
            return Resp::error($e->getMessage());
        }
    }

    /**
     * tools
     * @param null|string $type 类型
     * @return Factory|View
     */
    public function easyWeb($type = null)
    {
        $host = StrHelper::formatId(EnvHelper::host());
        return view('py-mgr-page::backend.home.easyweb.' . $type, [
            'host' => $host,
        ]);
    }

    /**
     * 获取后台的Auth
     * @return Guard|StatefulGuard
     */
    private function auth()
    {
        return Auth::guard(PamAccount::GUARD_BACKEND);
    }
}