<div class="form-group">
    {!! Form::label('category_id', trans('message.categories'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select name="category_id" class="form-control">
            <option disabled selected value>{{ trans('message.select_category') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    {!! Form::label('text', trans('message.admin_word.text'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('text', null, ['class' => 'form-control']) !!}
    </div>

</div>

<div class="input_fields_wrap">
    <div class="form-group answers">
        {!! Form::label('answer', trans('message.admin_word.answer'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <input type="text" name="answer[]" class="form-control">
        </div>
        {!! Form::radio('true_answer', config('constants.ANSWER_1')) !!}
    </div>
    <div class="form-group answers">
        {!! Form::label('answer', trans('message.admin_word.answer'), ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <input type="text" name="answer[]" class="form-control">
        </div>
        {!! Form::radio('true_answer', config('constants.ANSWER_2')) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4">
        {!! Form::button(trans('message.admin_word.add_more'), ['class' => 'add_field_button add_more']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : trans('message.admin_word.button_create'), ['class' => 'btn btn-primary']) !!}
    </div>
</div>

