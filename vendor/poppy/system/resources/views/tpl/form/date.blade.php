<div class="{{$viewClass['form-group']}} {!! (isset($errors) && $errors->has($errorKey)) ? 'has-error' : ''  !!}">
	<div class="{{$viewClass['label']}}">
		<label for="{{$id}}" class="layui-form-auto-label {{$viewClass['label_element']}}">
			@include('py-system::tpl.form.help-tip')
			{{$label}}
		</label>
	</div>
	<div class="{{$viewClass['field']}}">
		<div class="layui-form-auto-field">
			<div class="layui-inline">
				{!! app('form')->text($name, old($column, $value), $attributes + [
					'class' => 'layui-input',
					'id' => $id,
					'placeholder' => $placeholder,
				]) !!}
				<script>
				layui.laydate.render($.extend({
					elem : '#{!! $id !!}'
				}, {!! json_encode($options) !!}));
				</script>
			</div>
		</div>
		@include('py-system::tpl.form.help-block')
		@include('py-system::tpl.form.error')
	</div>
</div>
