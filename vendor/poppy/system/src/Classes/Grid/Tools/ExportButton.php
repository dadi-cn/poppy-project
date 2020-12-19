<?php namespace Poppy\System\Classes\Grid\Tools;

use Poppy\System\Classes\Grid;

class ExportButton extends AbstractTool
{
	/**
	 * @var Grid
	 */
	protected $grid;

	/**
	 * Create a new Export button instance.
	 *
	 * @param Grid $grid
	 */
	public function __construct(Grid $grid)
	{
		$this->grid = $grid;
	}

	/**
	 * Render Export button.
	 *
	 * @return string
	 */
	public function render()
	{
		if (!$this->grid->showExportBtn()) {
			return '';
		}

		$this->setUpScripts();

		$page      = request('page', 1);
		$variables = [
			'filter_id'            => $this->grid->getFilter()->getFilterId(),
			'export'               => trans('admin.export'),
			'all'                  => trans('admin.all'),
			'all_url'              => $this->grid->getExportUrl('all'),
			'current_page_url'     => $this->grid->getExportUrl('page', $page),
			'current_page'         => trans('admin.current_page'),
			'selected_rows'        => trans('admin.selected_rows'),
			'selected_rows_url'    => $this->grid->getExportUrl('selected', '__rows__'),
			'selected_export_name' => $this->grid->getExportSelectedName(),
		];


		return view('py-system::tpl.filter.export-button', $variables);
	}

	/**
	 * Set up script for export button.
	 */
	protected function setUpScripts()
	{
		$script = <<<SCRIPT

$('.{$this->grid->getExportSelectedName()}').click(function (e) {
    e.preventDefault();
    
    var rows = $.admin.grid.selected().join();

    if (!rows) {
        return false;
    }
    
    var href = $(this).attr('href').replace('__rows__', rows);
    location.href = href;
});

SCRIPT;

	}
}
