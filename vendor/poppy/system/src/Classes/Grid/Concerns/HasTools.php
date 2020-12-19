<?php namespace Poppy\System\Classes\Grid\Concerns;

use Closure;
use Poppy\System\Classes\Grid;
use Poppy\System\Classes\Grid\Tools;

trait HasTools
{
	use HasQuickSearch;

	/**
	 * Header tools.
	 *
	 * @var Tools
	 */
	public $tools;

	/**
	 * Disable header tools.
	 *
	 * @param bool $disable
	 * @return $this
	 */
	public function disableTools(bool $disable = true)
	{
		return $this->option('show_tools', !$disable);
	}

	/**
	 * Setup grid tools.
	 *
	 * @param Closure $callback
	 *
	 * @return void
	 */
	public function tools(Closure $callback)
	{
		call_user_func($callback, $this->tools);
	}

	/**
	 * Render custom tools.
	 *
	 * @return string
	 */
	public function renderHeaderTools()
	{
		return $this->tools->render();
	}

	/**
	 * If grid show header tools.
	 *
	 * @return bool
	 */
	public function showTools()
	{
		return $this->option('show_tools');
	}

	/**
	 * Setup grid tools.
	 *
	 * @param Grid $grid
	 * @return $this
	 */
	protected function initTools(Grid $grid)
	{
		$this->tools = new Tools($grid);
		return $this;
	}
}
