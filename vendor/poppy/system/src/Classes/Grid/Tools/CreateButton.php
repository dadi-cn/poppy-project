<?php namespace Poppy\System\Classes\Grid\Tools;

use Poppy\System\Classes\Grid;

/**
 * 创建按钮
 */
class CreateButton extends AbstractTool
{
	/**
	 * @var Grid
	 */
	protected $grid;

	/**
	 * Create a new CreateButton instance.
	 *
	 * @param Grid $grid
	 */
	public function __construct(Grid $grid)
	{
		$this->grid = $grid;
	}

	/**
	 * Render CreateButton.
	 *
	 * @return string
	 */
	public function render()
	{
		if (!$this->grid->showCreateBtn()) {
			return '';
		}

		$new = '新建';

		return <<<EOT
    <a href="{$this->grid->getCreateUrl()}" class="layui-btn layui-btn-sm layui-btn-normal J_iframe pull-right ml8" title="{$new}">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;{$new}</span>
    </a>
EOT;
	}
}
