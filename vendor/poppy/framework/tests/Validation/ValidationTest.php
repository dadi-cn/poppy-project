<?php namespace Poppy\Framework\Tests\Validation;

use Illuminate\Contracts\Container\BindingResolutionException;
use Poppy\Framework\Application\TestCase;

class ValidationTest extends TestCase
{
	/**
	 * mobile test
	 * @throws BindingResolutionException
	 */
	public function testMobile(): void
	{
		$mobile    = '17787876656';
		$validator = app('validator')->make([
			'mobile' => $mobile,
		], [
			'mobile' => 'mobile',
		], [], [
			'mobile' => '手机号',
		]);
		if ($validator->fails()) {
			$this->assertTrue(false);
		}
		else {
			$this->assertTrue(true);
		}
	}
}