{!! Form::open(['class'=> 'layui-form']) !!}
{!! Form::hidden('type', 'submit') !!}
<div class="layui-form-item">
    {!! Form::label('title', '必填项', ['class'=> 'validation']) !!}
    {!! Form::text('title', null, ['class' => 'layui-input', 'data-rule-required'=> 'true']) !!}
    <small class="layui-word-aux">这里是必填项目, 给 label 加一个 validation 类</small>
</div>
<div class="layui-form-item">
    {!! Form::label('date', '日期组件') !!}
    {!! PyForm::datePicker('date', null) !!}
</div>
<div class="layui-form-item">
    {!! Form::label('datetime', '时间日期时间') !!}
    {!! PyForm::datetimePicker('datetime', null, ['class' => 'layui-input',]) !!}
</div>
<div class="layui-form-item">
    {!! Form::label('reason', '封禁原因') !!}
    {!! Form::textarea('reason',null, ['class' => 'layui-textarea', 'rows'=> 3]) !!}
</div>
<div class="layui-form-item">
    {!! Form::label('editor', '编辑器') !!}
    {!! PyForm::editor('editor',null) !!}
</div>
<div class="layui-form-item">
    {!! Form::label('code', 'Code编辑器') !!}
    {!! PyForm::code('code', 'default code') !!}
</div>
<div class="layui-form-item">
    {!! Form::button('封禁', ['class'=>'layui-btn J_validate', 'type'=> 'submit']) !!}
</div>
{!! Form::close() !!}