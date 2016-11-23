<div class="form-group">
    {!! Form::label('name', trans('message.category.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', trans('message.category.description'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('message.create'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>
