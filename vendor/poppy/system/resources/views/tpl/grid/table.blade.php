<div class="layui-card">
	@if(isset($title))
		<div class="layui-card-title">
			{{ $title }}
		</div>
	@endif
	<div class="layui-card-body">
		<div class="layui-form layui-form-sm" lay-filter="{!! $filter_id !!}-tool">
			@if ( $grid->showTools() || $grid->showExportBtn() || $grid->showCreateBtn() )
				<div class="clearfix">
					<div class="pull-right">
						{!! $grid->renderExportButton() !!}
						{!! $grid->renderCreateButton() !!}
					</div>
					@if ( $grid->showTools() )
						<div class="pull-left">
							{!! $grid->renderHeaderTools() !!}
						</div>
					@endif
				</div>
			@endif
			{!! $grid->renderFilter() !!}
		</div>
		<script>
		layui.form.render(null, '{!! $filter_id !!}-tool')
		</script>
	</div>
</div>


{{--	{!! $grid->renderHeader() !!}--}}

<!-- /.box-header -->
<div class="box-body table-responsive no-padding">
	<table class="table table-hover grid-table">
		<thead>
		<tr>
			@foreach($grid->visibleColumns() as $column)
				{{--					<th {!! $column->formatHtmlAttributes() !!}>{!! $column->getLabel() !!}{!! $column->renderHeader() !!}</th>--}}
			@endforeach
		</tr>
		</thead>

		@if ($grid->hasQuickCreate())
			{{--				{!! $grid->renderQuickCreate() !!}--}}
		@endif

		<tbody>

		{{--			@if($grid->rows()->isEmpty() && $grid->showDefineEmptyPage())--}}
		{{--				@include('py-system::tpl.grid.empty-grid')--}}
		{{--			@endif--}}

		@foreach($grid->rows() as $row)
			<tr {!! $row->getRowAttributes() !!}>
				@foreach($grid->visibleColumnNames() as $name)
					<td {!! $row->getColumnAttributes($name) !!}>
						{!! $row->column($name) !!}
					</td>
				@endforeach
			</tr>
		@endforeach
		</tbody>

		{{--			{!! $grid->renderTotalRow() !!}--}}

	</table>

</div>

{{--	{!! $grid->renderFooter() !!}--}}

<!-- /.box-body -->

<table class="layui-hide" id="{!! $id !!}"></table>

<script>
layui.table.render($.extend({!! $lay !!}, {
	// 返回的数据去做解析
	request : {
		limitName : 'pagesize'
	},
	id : '{!! $filter_id !!}-table',
	parseData : function(resp) {
		return {
			code : resp.status,
			msg : resp.message,
			count : resp.data.pagination.total,
			data : resp.data.list
		};
	}
}));
$('#{!! $filter_id !!}-reload').on('click', function() {
	let values = $('#{!! $filter_id !!}-form').serializeArray();
	let query  = {};
	$.each(values, function(i, field) {
		query[field.name] = field.value;
	});
	layui.table.reload('{!! $filter_id !!}-table', {
		page : {
			curr : 1 //重新从第 1 页开始
		}
		, where : query
	}, 'data');
	return false;
});
</script>