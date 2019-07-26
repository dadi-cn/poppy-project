<?php
return [

	'system' => [
		/*
		|--------------------------------------------------------------------------
		| 接口文档的定义
		|--------------------------------------------------------------------------
		| 需要运行 `php artisan system:doc api` 来生成技术文档
		*/
		'apidoc' => [
			'web' => [
				// 标题
				'title'       => '前台接口',
				// 默认访问地址
				'default_url' => 'api_v1/system/captcha/image',
				// 测试工厂
				'factory'     => \System\Testing\Request\WebApiRequest::class,
			],
		],
	],

];