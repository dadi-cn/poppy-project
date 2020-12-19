<?php namespace Poppy\System\Classes\Grid\Tools;

use Illuminate\Support\Collection;
use Poppy\System\Classes\Grid;

class ColumnSelector extends AbstractTool
{
	const SELECT_COLUMN_NAME = '_columns_';

	/**
	 * @var Grid
	 */
	protected $grid;

	/**
	 * @var array
	 */
	protected static $ignoredColumns = [
		Grid\Column::SELECT_COLUMN_NAME,
		Grid\Column::ACTION_COLUMN_NAME,
	];

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
	 * {@inheritdoc}
	 *
	 * @return string
	 */
	public function render()
	{
		if (!$this->grid->showColumnSelector()) {
			return '';
		}

	}

	/**
	 * @return Collection
	 */
	protected function getGridColumns()
	{
		return $this->grid->columns()->map(function (Grid\Column $column) {
			$name = $column->getName();

			if ($this->isColumnIgnored($name)) {
				return;
			}

			return [$name => $column->getLabel()];
		})->filter()->collapse();
	}

	/**
	 * Is column ignored in column selector.
	 *
	 * @param string $name
	 *
	 * @return bool
	 */
	protected function isColumnIgnored($name)
	{
		return in_array($name, static::$ignoredColumns);
	}

	/**
	 * Ignore a column to display in column selector.
	 *
	 * @param string|array $name
	 */
	public static function ignore($name)
	{
		static::$ignoredColumns = array_merge(static::$ignoredColumns, (array) $name);
	}
}
