<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Category Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select name="category" class="form-control">
            <option disabled selected value>{{ trans('message.select_category') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
    {!! Form::label('text', 'Text', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('text', null, ['class' => 'form-control']) !!}

        {!! $errors->first('text', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="form-group {{ $errors->has('answer1') ? 'has-error' : ''}}">
    {!! Form::label('answer1', 'Answer1', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('answer1', null, ['class' => 'form-control']) !!}
        {!! $errors->first('answer1', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::radio('true_answer', config('constants.ANSWER_1')) !!}
</div>
<div class="form-group {{ $errors->has('answer2') ? 'has-error' : ''}}">
    {!! Form::label('answer2', 'Answer2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('answer2', null, ['class' => 'form-control']) !!}
        {!! $errors->first('answer2', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::radio('true_answer', config('constants.ANSWER_2')) !!}
</div>
<div class="form-group {{ $errors->has('answer3') ? 'has-error' : ''}}">
    {!! Form::label('answer3', 'Answer3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('answer3', null, ['class' => 'form-control']) !!}
        {!! $errors->first('answer3', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::radio('true_answer', config('constants.ANSWER_3')) !!}
</div>
<div class="form-group {{ $errors->has('answer4') ? 'has-error' : ''}}">
    {!! Form::label('answer4', 'Answer4', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('answer4', null, ['class' => 'form-control']) !!}
        {!! $errors->first('answer4', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::radio('true_answer', config('constants.ANSWER_4')) !!}
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>