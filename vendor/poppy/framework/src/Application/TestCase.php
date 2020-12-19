<?php namespace Poppy\Framework\Application;

use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Poppy\Faker\Generator;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\Framework\Foundation\Application;

/**
 * Main Test Case
 */
class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
	/**
	 * Creates the application.
	 */
	public function createApplication()
	{
		static $app;
		if (!$app) {
			$file         = __DIR__ . '/../../../../storage/bootstrap/app.php';
			$fileInVendor = __DIR__ . '/../../../../../storage/bootstrap/app.php';
			if (file_exists($file)) {
				$app = require_once $file;
			}
			elseif (file_exists($fileInVendor)) {
				$app = require_once $fileInVendor;
			}

			if ($app !== null) {
				$app->make(Kernel::class)->bootstrap();

				return $app;
			}
		}
		return $app;

	}

	/**
	 * Run Vendor Test
	 * @param array $vendors test here is must class
	 */
	public function poppyTestVendor(array $vendors = []): void
	{
		collect($vendors)->each(function ($class, $package) {
			$this->assertTrue(class_exists($class), "Class `{$class}` is not exist, run `composer require {$package}` to install");
		});
	}

	/**
	 * 返回当前容器
	 * @return Container|Application
	 */
	protected function poppyContainer()
	{
		return Container::getInstance();
	}

	/**
	 * @param array|string $vars 需要输出的内容
	 */
	protected function outputVariables($vars)
	{
		if (is_array($vars)) {
			var_export(json_encode($vars, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else {
			var_export($vars);
		}
	}

	/**
	 * @throws FakerException
	 */
	protected function pyFaker(): Generator
	{
		return py_faker();
	}
}