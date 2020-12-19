<?php namespace Poppy\System\Tests\Services;

use Poppy\Framework\Application\TestCase;
use Poppy\Framework\Exceptions\ApplicationException;

class ServicesTest extends TestCase
{

	public function setUp(): void
	{
		parent::setUp();

		sys_cache('py-core')->forget('module.repo.hooks');
		sys_cache('py-core')->forget('module.repo.module');
	}

	public function testUploadType()
	{
		try {
			$uploadTypes = sys_hook('poppy.system.upload_type');
			self::assertArrayHasKey('default', $uploadTypes);
		} catch (ApplicationException $e) {
			self::assertTrue(false, $e->getMessage());
		}
	}
}