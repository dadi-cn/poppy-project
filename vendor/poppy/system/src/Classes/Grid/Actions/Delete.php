<?php namespace Poppy\System\Classes\Grid\Actions;

use Illuminate\Database\Eloquent\Model;
use Poppy\System\Classes\Actions\Response;
use Poppy\System\Classes\Actions\RowAction;

class Delete extends RowAction
{
	/**
	 * @return array|null|string
	 */
	public function name()
	{
		return __('admin.delete');
	}

	/**
	 * @param Model $model
	 *
	 * @return Response
	 */
	public function handle(Model $model)
	{
		$trans = [
			'failed'    => trans('admin.delete_failed'),
			'succeeded' => trans('admin.delete_succeeded'),
		];

		try {
			$model->delete();
		} catch (\Exception $exception) {
			return $this->response()->error("{$trans['failed']} : {$exception->getMessage()}");
		}

		return $this->response()->success($trans['succeeded'])->refresh();
	}

	/**
	 * @return void
	 */
	public function dialog()
	{
		$this->question(trans('admin.delete_confirm'), '', ['confirmButtonColor' => '#d33']);
	}
}
