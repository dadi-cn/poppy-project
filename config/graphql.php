<?php

return [
	'schema'                => 'default',
	'schemas'               => [
		// 无权限即可访问
		'default' => [
		],
		// 前台用户权限
		'web'     => [
			'mutation' => [],
			'query'    => [],
		],
		// 后台权限
		'backend' => [
			'mutation' => [

				\System\Setting\Graphql\Mutation\BeSettingMutation::class,

			],
			'query'    => [

				\System\Setting\Graphql\Queries\BeSettingQuery::class,
				\System\Setting\Graphql\Queries\BeSettingListQuery::class,
				//validate

			],
		],
	],
	'middleware_schema'     => [
		'default' => ['cross'],
		'backend' => ['auth:jwt_backend', 'cross'],
		'web'     => ['auth:jwt_web', 'cross', 'profile_complete'],
	],
	'json_encoding_options' => JSON_UNESCAPED_UNICODE,
	'types'                 => [
		/* framework
		 -------------------------------------------- */
		// 分页
		\Poppy\Framework\Http\Graphql\Inputs\InputPaginationType::class,
		\Poppy\Framework\Http\Graphql\Types\PaginationType::class,

		/* query
		 -------------------------------------------- */

		// resp
		\System\Setting\Graphql\Types\RespType::class,

		\System\Setting\Graphql\Types\BeSettingType::class,

	],
];