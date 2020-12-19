<div class="layui-form">
	{!! app('form')->checkbox('filter', 1, $expand ? 1 : null, [
		'lay-skin'    => 'primary',
		'lay-filter'  => '_filter_',
		'title'       => '筛选',
	]) !!}
	@if($scopes->isNotEmpty())
		<button type="button" class="btn btn-sm btn-dropbox dropdown-toggle" data-toggle="dropdown">

			<span>{{ $label }}</span>
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
		</button>
		<ul class="dropdown-menu" role="menu">
			@foreach($scopes as $scope)
				{!! $scope->render() !!}
			@endforeach
			<li role="separator" class="divider"></li>
			<li><a href="{{ $cancel }}">{{ trans('admin.cancel') }}</a></li>
		</ul>
	@endif
</div>

<script>
$(function() {
	layui.form.on('checkbox(_filter_)', function(data) {
		if (data.elem.checked) {
			$('#{!! $filter_id !!}-form').show();
		} else {
			$('#{!! $filter_id !!}-form').hide();
		}
	})
})
</script>