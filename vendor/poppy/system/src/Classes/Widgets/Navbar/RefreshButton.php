<?php namespace Poppy\System\Classes\Widgets\Navbar;

use Illuminate\Contracts\Support\Renderable;

class RefreshButton implements Renderable
{
	public function render()
	{
		$message = __('admin.refresh_succeeded');

		$script = <<<SCRIPT
$('.container-refresh').off('click').on('click', function() {
    $.admin.reload();
    $.admin.toastr.success('{$message}', '', {positionClass:"toast-top-center"});
});
SCRIPT;


		return <<<'EOT'
<li>
    <a href="javascript:void(0);" class="container-refresh">
      <i class="fa fa-refresh"></i>
    </a>
</li>
EOT;
	}
}
