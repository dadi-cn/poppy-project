<?php namespace Poppy\System\Tests\Action;

use Poppy\Framework\Exceptions\FakerException;
use Poppy\System\Action\Verification;
use Poppy\System\Tests\Base\SystemTestCase;

class CaptchaTest extends SystemTestCase
{

    protected $verification;

    public function setUp(): void
    {
        parent::setUp();

        $this->verification = new Verification();
    }

    /**
     * @throws FakerException
     */
    public function testCaptcha()
    {
        $Verification = new Verification();
        $mobile       = $this->faker()->phoneNumber;
        if ($Verification->genCaptcha($mobile)) {

            // re generate
            $false = $Verification->genCaptcha($mobile);
            $this->assertFalse($false);

            $captcha = $Verification->getCaptcha();
            $this->assertTrue($Verification->checkCaptcha($mobile, $captcha));
        }
        else {
            $this->assertTrue(false, $Verification->getError());
        }

        $mobile = $this->faker()->phoneNumber;
        $Verification->genCaptcha($mobile, 5, 4);
        $captcha = $Verification->getCaptcha();
        $this->assertEquals(4, strlen($captcha));
    }

    /**
     * 验证一次验证码
     */
    public function testOnceCode()
    {
        $hidden   = 'once-code';
        $onceCode = $this->verification->genOnceVerifyCode(5, $hidden);
        $this->verification->verifyOnceCode($onceCode);
        $this->assertEquals($hidden, $this->verification->getHiddenStr());
    }
}
