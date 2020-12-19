<?php namespace Poppy\System\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Exceptions\FormException;

class FormSettingPam extends FormSettingBase
{
    public $title = 'Pam设置';

    protected $group = 'py-system::pam';

    /**
     * Build a form here.
     * @throws FormException
     */
    public function form()
    {
        $this->text('disabled_reason', '账号被封禁原因')->rules([
            Rule::nullable(),
        ])->placeholder('账号被封禁原因');
        $this->text('prefix', '账号前缀')->rules([
            Rule::required(),
        ])->placeholder('请输入账号前缀, 用于账号注册默认用户名生成');
        $this->textarea('disable_reason', '封禁提示')->placeholder('当后台封禁该用户, 时候给予用户的提示信息, 没有则使用默认的系统封禁提示');
        $this->textarea('test_account', '测试账号')->placeholder('请填写测试账号, 每行一个')->help('在此测试账号内的应用, 不需要正确的验证码即可登录');
    }
}
