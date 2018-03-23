<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Pagination Num
	|--------------------------------------------------------------------------
	|
	*/
	'pagesize' => 20,

	'extension' => [
		'fe'       => [
			'catalog' => [
				'dailian' => [
					'origin' => 'modules/system/src/request',
					'doc'    => 'public/docs/system',
				],
			],
		],
		'ip_store' => [
			'type' => 'mon17',
		],
	],
];