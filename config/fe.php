<?php
return [
	/*
	|--------------------------------------------------------------------------
	| disk to save public url
	|--------------------------------------------------------------------------
	*/
	'disk'    => 'public',

	/*
	|--------------------------------------------------------------------------
	| folder position
	|--------------------------------------------------------------------------
	*/
	'folder'  => [
		'js_dir'   => 'resources/js',
		'font_dir' => 'resources/fonts',
		'scss_dir' => 'resources/scss',
	],

	/*
	|--------------------------------------------------------------------------
	| bower definition
	|--------------------------------------------------------------------------
	| js       : js path define
	| js.main  : main file
	| js.aim   : aim file position {VERSION} is version number.
	| font     : font reflection
	| css      : css reflection
	| shim     : dependence in requirejs.
	| key      : config key
	*/
	'bower'   => [

		'animate.css' => [
			'css' => [
				'animate.css' => 'animate/animate.css',
			],
			'key' => 'animate.css',
		],

		'ace-builds' => [
			'js'   => [
				'main'    => 'src/ace.js',
				'aim'     => 'ace/{VERSION}/ace.js',
				'dispose' => [
					'src/*' => 'ace/{VERSION}/',
				],
				'config'  => [
					// 和 key 相同, 覆盖掉 key 的定义位置
					'__same' => '',
				],
			],
			'key'  => 'ace',
			'shim' => [
				'exports' => 'ace',
			],
		],

		'bootstrap' => [
			'js'   => [
				'main' => 'dist/js/bootstrap.js',
				'aim'  => 'bt3/{VERSION}/bootstrap.js',
			],
			'css'  => [
				'dist/css/bootstrap.css'       => 'bt3/{VERSION}/css/bootstrap.css',
				'dist/css/bootstrap-theme.css' => 'bt3/{VERSION}/css/bootstrap-theme.css',
				'dist/fonts/*'                 => 'bt3/{VERSION}/fonts/',
			],
			'shim' => ['jquery'],
			'key'  => 'bt3',
		],

		'bootstrap-hover-dropdown' => [
			'js'   => [
				'aim' => 'bt3/hover-dropdown/{VERSION}/bt3.hover-dropdown.js',
			],
			'shim' => ['jquery', 'bt3'],
			'key'  => 'bt3.hover-dropdown',
		],
		'bootstrap-validator'      => [
			'js'   => [
				'aim' => 'bt3/validator/{VERSION}/bt3.validator.js',
			],
			'shim' => ['jquery', 'bt3'],
			'key'  => 'bt3.validator',
		],
		'centrifuge'               => [
			'js' => [
				'aim' => 'centrifuge/{VERSION}/centrifuge.js',
			],
		],
		'clipboard'                => [
			'js' => [
				'aim' => 'clipboard/{VERSION}/clipboard.min.js',
			],
		],

		'datatables.net' => [
			'js'   => [
				'main' => 'js/jquery.dataTables.js',
				'aim'  => 'jquery/data-tables/{VERSION}/jquery.data-tables.js',
			],
			'shim' => ['jquery'],
		],

		'datatables.net-bs' => [
			'js'   => [
				'main' => 'js/dataTables.bootstrap.js',
				'aim'  => 'bt3/data-tables/{VERSION}/bt3.data-tables.js',
			],
			'css'  => [
				'css/dataTables.bootstrap.css' => 'bt3/data-tables/data-tables.bootstrap.css',
			],
			'key'  => 'bt3.data-tables',
			'shim' => ['jquery', 'bt3'],
		],

		'fex-webuploader' => [
			'js'   => [
				'aim' => 'jquery/webuploader/{VERSION}/jquery.webuploader.js',
			],
			'css'  => [
				'dist/*.css' => 'jquery/webuploader/',
			],
			'key'  => 'jquery.webuploader',
			'shim' => ['jquery'],
		],

		'jquery' => [
			'js' => [
				'main' => 'jquery.min.js',
				'aim'  => 'jquery/{VERSION}/jquery.min.js',
			],
		],

		'layer' => [
			'js'   => [
				'main' => 'src/layer.js',
				'aim'  => 'jquery/layer/{VERSION}/jquery.layer.js',
			],
			'css'  => [
				'src/theme/*' => 'jquery/layer/',
			],
			'key'  => 'jquery.layer',
			'shim' => ['jquery'],
		],

		'image-picker' => [
			'js'   => [
				'aim' => 'jquery/image-picker/{VERSION}/jquery.image-picker.js',
			],
			'css'  => [
				'image-picker/image-picker.css' => 'jquery/image-picker/image-picker.css',
			],
			'key'  => 'jquery.image-picker',
			'shim' => ['jquery'],
		],

		'sockjs' => [
			'js' => [
				'aim' => 'sockjs/{VERSION}/sockjs.js',
			],
		],

		'toastr' => [
			'js'   => [
				'main' => 'toastr.min.js',
				'aim'  => 'jquery/toastr/{VERSION}/jquery.toastr.js',
			],
			'css'  => [
				'toastr.css' => 'jquery/toastr/toastr.css',
			],
			'key'  => 'jquery.toastr',
			'shim' => ['jquery'],
		],

		'tokenize2' => [
			'js'   => [
				'main' => 'dist/tokenize2.min.js',
				'aim'  => 'jquery/tokenize2/{VERSION}/jquery.tokenize2.js',
			],
			'css'  => [
				'dist/tokenize2.min.css' => 'jquery/tokenize2/tokenize2.min.css',
			],
			'key'  => 'jquery.tokenize2',
			'shim' => ['jquery'],
		],

		'jquery-form' => [
			'js'   => [
				'aim' => 'jquery/form/{VERSION}/jquery.form.js',
			],
			'key'  => 'jquery.form',
			'shim' => ['jquery'],
		],

		'jquery-validation' => [
			'js'   => [
				'aim' => 'jquery/validation/{VERSION}/jquery.validation.js',
			],
			'key'  => 'jquery.validation',
			'shim' => ['jquery'],
		],

		'jquery-slimscroll' => [
			'js'   => [
				'main' => 'jquery.slimscroll.min.js',
				'aim'  => 'jquery/slimscroll/{VERSION}/jquery.slimscroll.min.js',
			],
			'key'  => 'jquery.slimscroll',
			'shim' => ['jquery'],
		],

		'js-cookie' => [
			'js'   => [
				'main' => 'src/js.cookie.js',
				'aim'  => 'js-cookie/{VERSION}/js-cookie.js',
			],
			'shim' => [
				'exports' => 'Cookies',
			],
		],

		'json' => [
			'js'   => [
				'aim' => 'json/json2.js',
			],
			'shim' => [
				'exports' => 'JSON',
			],
		],

		'smooth-scroll' => [
			'js'  => [
				'main' => 'smooth-scroll.js',
				'aim'  => 'smooth-scroll/{VERSION}/smooth-scroll.js',
			],
			'key' => 'smooth-scroll',
		],

		'vkBeautify' => [
			'js'   => [
				'main' => 'vkbeautify.js',
				'aim'  => 'vkbeautify/vkbeautify.js',
			],
			'key'  => 'vkbeautify',
			'shim' => [
				'exports' => 'vkbeautify',
			],
		],

		'metisMenu' => [
			'js'  => [
				'main' => 'dist/metisMenu.js',
				'aim'  => 'jquery/metis-menu/{VERSION}/jquery.metis-menu.js',
			],
			'css' => [
				'dist/*.css' => 'jquery/metis-menu/',
			],
			'key' => 'jquery.metis-menu',
		],

		'requirejs' => [
			'js'  => [
				'main' => 'require.js',
				'aim'  => 'requirejs/require.js',
			],
			'key' => 'requirejs',
		],

		'PACE' => [
			'js'  => [
				'main' => 'pace.min.js',
				'aim'  => 'pace/{VERSION}/pace.min.js',
			],
			'css' => [
				'themes/*' => 'pace/',
			],
			'key' => 'pace',
		],

		'underscore' => [
			'js' => [
				'main' => 'underscore-min.js',
				'aim'  => 'underscore/{VERSION}/underscore-min.js',
			],
		],
		'vue'        => [
			'js' => [
				'main' => 'dist/vue.min.js',
				'aim'  => 'vue/{VERSION}/vue.min.js',
			],
		],

	],
	'global'  => [
		'url_site' => env('URL_SITE'),
		'url_js'   => env('URL_SITE') . '/resources/js',
	],
	'appends' => [
		'poppy'   => env('URL_SITE') . '/resources/js/poppy',
		'develop' => env('URL_SITE') . '/modules/develop/js',
	],

	'apidoc' => [
		'web'     => [
			'title'       => '前台接口',
			'origin'      => 'modules',
			'filter'      => [
				'system/src/request/api_v1/util/.*\.php$',
				'system/src/request/api_v1/pam/.*\.php$',
				'order/src/request/api_v1/web/.*\.php$',
				'user/src/request/api_v1/web/.*\.php$',
				'finance/src/request/api_v1/web/.*\.php$',
			],
			'doc'         => 'public/docs/web',
			'default_url' => 'api_v1/util/area/code',
		],
		'backend' => [
			'title'       => '后台接口',
			'origin'      => 'modules',
			'filter'      => [
				'system/src/request/api_v1/backend/.*\.php$',
				'order/src/request/api_v1/backend/.*\.php$',
				'finance/src/request/api_v1/backend/.*\.php$',
				'user/src/request/api_v1/backend/.*\.php$',
				'sundry/src/request/api_v1/backend/.*\.php$',
			],
			'doc'         => 'public/docs/backend',
			'default_url' => 'api_v1/backend/system/role/permissions',
		],
	],
];