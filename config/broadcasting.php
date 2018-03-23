<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Broadcaster
	|--------------------------------------------------------------------------
	|
	| This option controls the default broadcaster that will be used by the
	| framework when an event needs to be broadcast. You may set this to
	| any of the connections defined in the "connections" array below.
	|
	*/

	'default' => env('BROADCAST_DRIVER', 'pusher'),

	/*
	|--------------------------------------------------------------------------
	| Broadcast Connections
	|--------------------------------------------------------------------------
	|
	| Here you may define all of the broadcast connections that will be used
	| to broadcast events to other systems or over websockets. Samples of
	| each available type of connection are provided inside this array.
	|
	*/

	'connections' => [

		'pusher' => [
			'driver' => 'pusher',
			'key'    => env('PUSHER_KEY'),
			'secret' => env('PUSHER_SECRET'),
			'app_id' => env('PUSHER_APP_ID'),
		],

		'centrifuge' => [
			'driver'           => 'centrifuge',
			// you secret key
			'secret'           => env('CENTRIFUGE_SECRET'),
			// centrifuge api url
			'url'              => env('CENTRIFUGE_URL', 'http://localhost:8000'),
			// enable or disable Redis API
			'redis_api'        => env('CENTRIFUGE_REDIS_API', false),
			// name of redis connection
			'redis_connection' => env('CENTRIFUGE_REDIS_CONNECTION', 'default'),
			// prefix name for queue in Redis
			'redis_prefix'     => env('CENTRIFUGE_REDIS_PREFIX', 'centrifugo'),
			// number of shards for redis API queue
			'redis_num_shards' => env('CENTRIFUGE_REDIS_NUM_SHARDS', 0),
			// Verify host ssl if centrifuge uses this
			'verify'           => env('CENTRIFUGE_VERIFY', false),
			// Self-Signed SSl Key for Host (require verify=true)
			'ssl_key'          => env('CENTRIFUGE_SSL_KEY', null),
		],

		'redis' => [
			'driver'     => 'redis',
			'connection' => 'default',
		],

		'log' => [
			'driver' => 'log',
		],

	],

];
