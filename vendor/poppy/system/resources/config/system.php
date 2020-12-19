<?php

return [

	'system' => [

		/*
		|--------------------------------------------------------------------------
		| EnableCross Domain
		|--------------------------------------------------------------------------
		|
		*/
		'enable_cross'      => [
			// 允许的来源
			'origin'  => '*',
			// 允许的Header
			'headers' => '',
		],


		/*
		|--------------------------------------------------------------------------
		| CSRF Token
		| 不进行 CSRF 的地址
		|--------------------------------------------------------------------------
		|
		*/
		'csrf_except'       => [

		],


		/*
		|--------------------------------------------------------------------------
		| Encrypt cookies
		| 对这些数据进行 Cookie 原样输出
		|--------------------------------------------------------------------------
		|
		*/
		'uncrypt_cookies'   => [

		],

		/*
		|--------------------------------------------------------------------------
		| 密码加载器
		|--------------------------------------------------------------------------
		| 这里为了兼容多个平台进行相应的密码校验算法
		| 这里需要实现 PasswordContract
		*/
		'password_provider' => '',

		/*
		|--------------------------------------------------------------------------
		| 支付的类型, 用于区分进行回调
		|--------------------------------------------------------------------------
		|
		*/
		'payment_types'     => [

		],

		/*
		|--------------------------------------------------------------------------
		| 后台可以隐藏的路由, 写在这里, 后台列表不予显示
		|--------------------------------------------------------------------------
		|
		*/
		'route_hide'        => [

		],


		/* 登录跳转的几个地址
        * ---------------------------------------- */
		'dev_login'         => '/develop/login',
		'backend_login'     => '/backend/login',
		'user_login'        => '/login',


		/*
		|--------------------------------------------------------------------------
		| ApiSign 验证
		|--------------------------------------------------------------------------
		|
		*/
		'api_sign_provider' => '',

		/*
		|--------------------------------------------------------------------------
		| 是否进行签名验证
		|--------------------------------------------------------------------------
		|
		*/
		'api_enable_sign'   => true,

		/*
		|--------------------------------------------------------------------------
		| 后台登录的地址
		|--------------------------------------------------------------------------
		|
		*/
		'prefix'            => 'mgr-page',


		/*
		|--------------------------------------------------------------------------
		| 开发配置
		|--------------------------------------------------------------------------
		|
		*/
		'develop'           => [

			/* 开发登录的前缀地址
			 * ---------------------------------------- */
			'prefix' => 'develop',
		],
	],

];