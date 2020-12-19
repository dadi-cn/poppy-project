<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Classes\Traits\SystemTrait;
use Poppy\System\Http\Forms\Backend\FormMailStore;
use Poppy\System\Http\Forms\Backend\FormMailTest;

/**
 * 邮件控制器
 */
class MailController extends BackendController
{
    use SystemTrait;

    public function __construct()
    {
        parent::__construct();

        self::$permission = [
            'global' => 'backend:py-system.global.manage',
        ];
    }

    /**
     * 保存邮件配置
     * @return array|JsonResponse|RedirectResponse|Response|Redirector|Resp|Content|\Response
     */
    public function store()
    {
        return (new Content())->body(new FormMailStore());
    }

    /**
     * 测试邮件发送
     */
    public function test()
    {
        return (new Content())->body(new FormMailTest());
    }
}
