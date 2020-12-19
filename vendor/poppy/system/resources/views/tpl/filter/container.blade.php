<form action="{!! $action !!}" method="get" id="{{ $filterID }}-form" class="layui-form layui-form-sm{!! $expand ? '': 'hide' !!}">
	<hr>
	<div class="layui-row">
		@foreach($layout->columns() as $column)
			<div class="layui-col-md{{ $column->width() }}">
				@foreach($column->filters() as $filter)
					{!! $filter->render() !!}
				@endforeach
			</div>
		@endforeach
	</div>
	<hr>
	<div class="layui-row">
		<div class="layui-col-md12 text-center">
			<button class="layui-btn layui-btn-info  layui-btn-sm" id="{{ $filterID }}-reload"><i class="fa fa-search"></i>&nbsp;搜索</button>
			<a href="{!! $action !!}" class="layui-btn layui-btn-primary layui-btn-sm J_ignore"><i class="fa fa-undo"></i>&nbsp;重置</a>
		</div>
	</div>
</form>