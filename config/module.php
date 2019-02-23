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
			'web'      => [
				'title'            => '前台接口',
				'origin'           => 'modules',
				'filter'           => [
					'area/src/request/api_v1/web/.*\.php$',
					'site/src/request/api_v1/web/.*\.php$',
					'system/src/request/api_v1/util/.*\.php$',
					'system/src/request/api_v1/pam/.*\.php$',
					'order/src/request/api_v1/web/.*\.php$',
					'order/src/request/api_v2/web/.*\.php$',
					'user/src/request/api_v1/web/.*\.php$',
					'finance/src/request/api_v1/web/.*\.php$',
					'finance/src/request/api_v2/web/.*\.php$',
					'sundry/src/request/api_v1/web/.*\.php$',
					'car/src/request/api_v1/web/.*\.php$',
					'custom/src/request/api_v1/web/.*\.php$',
					'custom/src/request/api_v2/web/.*\.php$',
					'user/src/request/api_v2/web/.*\.php$',
					'car/src/request/api_v2/web/.*\.php$',
					'coupon/src/request/api_v2/web/.*\.php$',
					'user/src/request/api_v3/web/.*\.php$',
				],
				'doc'              => 'public/docs/web',
				'default_url'      => 'api_v1/util/area/code',
				'check'            => [
					'steam_id'      => 'String',
					'device_id'     => 'String',
					'wx_open_id'    => 'String',
					'partner_id'    => 'String',
					'prepay_id'     => 'String',
					'dan_ids'       => 'String',
					'access_key_id' => 'String',
				],
				'sign_certificate' => [
					[
						'name'        => 'timestamp',
						'title'       => 'TimeStamp',
						'type'        => 'String',
						'is_required' => 'Y',
					],
				],
				'sign_generate'    => '
        var params = [];
        var str = "";

        function _sign(tip) {
	        $("input[name=sign]").val(tip);
        }

        function _val(name) {
	        return $("input[name=" + name + "]").val();
        }

        $(".J_calc").each(function(i, ele) {
	        params.push($(ele).attr("name"));
        });

        params = _.without(params, "sign", "token", "image");
        params.sort();

        _.each(params, function(key) {
	        str += key + "=" + _val(key) + ","
        });
        str = str.slice(0, -1);
        
        var md5 = hex_md5(str);
        var token = _val("token");
        var step1 = str;
        var step2 = hex_md5(str)+_val("token");
        var md5Secret = hex_md5(hex_md5(str)+_val("token"));
        var md5Short = md5Secret.charAt(1) + md5Secret.charAt(3) + md5Secret.charAt(15) + md5Secret.charAt(31)
        console.warn("step 1(origin):"+step1+"\n step2(md5 once):"+step2+"\n step3(md5 twice):"+md5Secret+"\n sign : "+ md5Short);
        _sign(md5Short);
',
			],
			'owner'    => [
				'title'       => '号主接口',
				'origin'      => 'modules',
				'filter'      => [
					'custom/src/request/api_v1/owner/.*\.php$',
				],
				'doc'         => 'public/docs/owner',
				'default_url' => 'api_v1/owner/custom/detail',
				'check'       => [],
			],
			'merchant' => [
				'title'            => '商户接口',
				'origin'           => 'modules',
				'filter'           => [
					'custom/src/request/api_v1/merchant/.*\.php$',
				],
				'doc'              => 'public/docs/merchant',
				'default_url'      => 'api_v1/merchant/custom/establish',
				'sign_token'       => false,
				'sign_certificate' => [
					[
						'name'        => 'app_key',
						'title'       => 'AppKey',
						'type'        => 'String',
						'is_required' => 'Y',
					],
					[
						'name'        => 'app_secret',
						'title'       => 'AppSecret',
						'type'        => 'String',
						'is_required' => 'Y',
					],
					[
						'name'        => 'timestamp',
						'title'       => 'TimeStamp',
						'type'        => 'String',
						'is_required' => 'Y',
					],
				],
				'sign_generate'    => '
        var params = [];
        var str = "";

        function _sign(tip) {
	        $("input[name=sign]").val(tip);
        }

        function _val(name) {
	        return $("input[name=" + name + "]").val();
        }

        $(".J_calc").each(function(i, ele) {
	        params.push($(ele).attr("name"));
        });

        params = _.without(params, "sign");
        params.sort();

        _.each(params, function(key) {
	        str += key + "=" + _val(key) + ","
        });
        str = str.slice(0, -1);
        
        var md5 = hex_md5(str);
        var md5Secret = hex_md5(hex_md5(str)+_val("app_secret"));
        console.warn("md5 param:"+md5+"\n md5 secret:"+md5Secret);
        _sign(md5Secret);
',

			],
		],
	],

];