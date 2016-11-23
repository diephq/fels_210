<div class="form-group">
    {!! Form::label('name', trans('message.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', trans('message.email'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password', trans('message.password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password', trans('message.confirm_password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('message.button_create'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
