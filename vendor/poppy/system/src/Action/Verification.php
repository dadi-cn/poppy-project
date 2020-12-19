<?php namespace Poppy\System\Action;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Helper\EnvHelper;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Helper\UtilHelper;

/**
 * 系统校验
 */
class Verification
{
    use AppTrait;

    const CK_ONCE    = 'py-system:verification-once_code';
    const CK_CAPTCHA = 'py-system:verification-captcha';

    const TYPE_MAIL   = 'mail';
    const TYPE_MOBILE = 'mobile';

    /**
     * @var string 隐藏在加密中的字符串
     */
    private $hiddenStr;

    /**
     * @var string
     */
    private $captcha;
    /**
     * @var string
     */
    private $passportKey;

    /**
     * @var RdsDb
     */
    private static $db;


    public function __construct()
    {
        self::$db = new RdsDb();
    }

    /**
     * @param string $passport    需要发送的通行证
     * @param int    $expired_min 过期时间
     * @param int    $length      验证码长度
     * @return bool
     */
    public function genCaptcha(string $passport, $expired_min = 5, $length = 6): bool
    {

        if (!$this->checkPassport($passport)) {
            return false;
        }
        $key = $this->passportKey;
        if ($data = self::$db->get(self::CK_CAPTCHA . ':' . $key)) {
            if ($data['silence'] > Carbon::now()->timestamp) {
                return $this->setError('发送验证码操作过于频繁，请稍后尝试');
            }
        }

        // 发送
        $captcha = StrHelper::randomCustom($length, '0123456789');
        $data    = [
            'captcha' => $captcha,
            'silence' => Carbon::now()->timestamp + 60,
        ];
        self::$db->set(self::CK_CAPTCHA . ':' . $key, $data, 'ex', $expired_min * 60);

        $this->captcha = $captcha;
        return true;
    }

    /**
     * 验证验证码
     * @param string $passport 通行证
     * @param string $captcha  验证码
     * @return bool
     */
    public function checkCaptcha(string $passport, string $captcha): bool
    {
        if (!$this->checkPassport($passport)) {
            return false;
        }
        $key = $this->passportKey;

        /* 测试账号验证码/正确的验证码即可登录
         * ---------------------------------------- */
        $strAccount = trim(sys_setting('py-system::pam.test_account'));
        if ($strAccount) {
            $explode     = EnvHelper::isWindows() ? "\n" : PHP_EOL;
            $testAccount = explode($explode, sys_setting('py-system::pam.test_account'));
            if (count($testAccount)) {
                $testAccount = collect(array_map(function ($item) {
                    $account = explode(':', $item);

                    return [
                        'passport' => trim($account[0] ?? ''),
                        'captcha'  => trim($account[1] ?? ''),
                    ];
                }, $testAccount));
                $item        = $testAccount->where('passport', $passport)->first();
                if ($item) {
                    $captcha      = (string) $captcha;
                    $savedCaptcha = (string) ($item['captcha'] ?? '');
                    if ($savedCaptcha && $captcha !== $savedCaptcha) {
                        return $this->setError('验证码不正确!');
                    }

                    return true;
                }
            }
        }

        if ($data = self::$db->get(self::CK_CAPTCHA . ':' . $key)) {
            if ((string) $data['captcha'] === (string) $captcha) {
                self::$db->del(self::CK_CAPTCHA . ':' . $key);
                return true;
            }
        }
        else {
            return $this->setError('验证码已过期, 请重新发送');
        }

        return $this->setError(trans('py-system::action.verification.check_captcha_error'));
    }

    /**
     * 生成一次验证码
     * @param int    $expired_min 过期时间
     * @param string $hidden_str  隐藏的验证字串
     * @return string
     */
    public function genOnceVerifyCode($expired_min = 10, $hidden_str = ''): string
    {
        $randStr = Str::random(16);
        if (!$hidden_str) {
            $hidden_str = Str::random(6);
        }
        $str  = [
            'hidden' => $hidden_str,
            'random' => $randStr . '@' . Carbon::now()->timestamp,
        ];
        $code = md5(json_encode($str));
        self::$db->set(self::CK_ONCE . ':' . $code, $str, 'ex', $expired_min * 60);
        return $code;
    }

    /**
     * 需要验证的验证码
     * @param string $code   一次验证码
     * @param bool   $forget 是否删除验证码
     * @return bool
     */
    public function verifyOnceCode(string $code, $forget = true)
    {
        if ($data = self::$db->get(self::CK_ONCE . ':' . $code, true)) {
            $this->hiddenStr = $data['hidden'];
            if ($forget) {
                self::$db->del(self::CK_ONCE);
            }
            return true;
        }
        return $this->setError(trans('py-system::action.verification.verify_code_error'));
    }

    public function removeOnceCode($code)
    {
        self::$db->del(self::CK_ONCE . ':' . $code);
        return true;
    }

    /**
     * @return string
     */
    public function getHiddenStr(): string
    {
        return $this->hiddenStr;
    }

    /**
     * @return string
     */
    public function getCaptcha(): string
    {
        return $this->captcha;
    }

    private function checkPassport($passport)
    {
        // 验证数据格式
        if (UtilHelper::isEmail($passport)) {
            $passportType = self::TYPE_MAIL;
        }
        elseif (UtilHelper::isMobile($passport)) {
            $passportType = self::TYPE_MOBILE;
        }
        else {
            return $this->setError(trans('py-system::action.verification.send_passport_format_error'));
        }
        $this->passportKey = $passportType . '-' . $passport;
        return true;
    }
}
