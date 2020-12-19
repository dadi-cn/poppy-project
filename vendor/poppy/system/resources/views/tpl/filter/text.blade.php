<div class="layui-input-group">
	@if($group)
		{!! app('form')->select($id .'_group', $group, null, [
			'lay-filter' => $id.'-lay-filter'
		]) !!}
		<script>
		layui.form.render('select', '{!! $id !!}-lay-filter');
		</script>
	@endif
	<input type="{{ $type }}" title="{!! $label !!}"
		class="J_tooltip layui-input {{ $id }}" placeholder="{{$placeholder}}" name="{{$name}}" value="{{ request($name, $value) }}">
</div>