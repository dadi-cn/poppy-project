<?php namespace Poppy\System\Classes\Abstracts;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

abstract class SysRouteServiceProvider extends ServiceProvider
{
	protected $backendPrefix;


	protected $developPrefix;


	public function __construct($app)
	{
		parent::__construct($app);

		$this->backendPrefix = config('poppy.system.prefix') ?: 'backend';
		dump(config('poppy.system.prefix'));
		dump($this->backendPrefix);
		$this->developPrefix = config('poppy.system.develop.prefix') ?: 'develop';
	}
}