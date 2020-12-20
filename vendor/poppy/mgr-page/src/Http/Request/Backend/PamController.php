<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Illuminate\View\View;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Forms\Backend\FormPamDisable;
use Poppy\System\Http\Forms\Backend\FormPamEnable;
use Poppy\System\Http\Forms\Backend\FormPamEstablish;
use Poppy\System\Http\Forms\Backend\FormPamPassword;
use Poppy\System\Models\Filters\PamAccountFilter;
use Poppy\System\Models\Filters\PamLogFilter;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamLog;
use Poppy\System\Models\PamRole;

/**
 * 账户管理
 */
class PamController extends BackendController
{
    public function __construct()
    {
        parent::__construct();

        self::$permission = [
            'global' => 'backend:py-system.pam.manage',
            'log'    => 'backend:py-system.pam.log',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $input         = input();
        $type          = sys_get($input, 'type', PamAccount::TYPE_BACKEND);
        $input['type'] = $type;
        $types         = PamAccount::kvType();
        $items         = PamAccount::filter($input, PamAccountFilter::class)->paginateFilter($this->pagesize);

        return view('py-mgr-page::backend.pam.index', [
            'items' => $items,
            'type'  => $type,
            'types' => $types,
            'roles' => PamRole::getLinear($type),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param null|int $id ID
     * @return Content
     */
    public function establish($id = null)
    {
        $form = new FormPamEstablish();
        $form->setType(input('type'))->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 设置密码
     * @param int $id 用户ID
     * @return Content
     * @throws ApplicationException
     */
    public function password($id)
    {
        $form = new FormPamPassword();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 禁用用户
     * @param int $id 用户ID
     * @return Content
     */
    public function disable($id)
    {
        $form = new FormPamDisable();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 启用用户
     * @param int $id 用户ID
     * @return Content
     */
    public function enable($id)
    {
        $form = new FormPamEnable();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * @return View
     */
    public function log(): View
    {
        $input = input();
        $items = PamLog::filter($input, PamLogFilter::class)
            ->orderBy('id', 'desc')
            ->paginate($this->pagesize)
            ->appends($input);

        return view('py-mgr-page::backend.pam.log', [
            'items' => $items,
        ]);
    }
}