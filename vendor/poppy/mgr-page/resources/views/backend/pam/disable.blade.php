@extends('py-mgr-page::backend.tpl.dialog')
@section('backend-main')
    {!! Form::open(['route'=> [$_route, $id]]) !!}
    <div class="layui-form-item">
        {!! Form::label('date', '解禁日期') !!}
        {!! PyForm::datePicker('date', input('date'), ['class' => 'layui-input']) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::label('reason', '封禁原因') !!}
        {!! Form::textarea('reason',null, ['class' => 'layui-textarea', 'rows'=> 3]) !!}
    </div>
    <div class="layui-form-item">
        {!! Form::button('封禁', ['class'=>'layui-btn J_submit', 'type'=> 'submit']) !!}
    </div>
    {!! Form::close() !!}
@endsection