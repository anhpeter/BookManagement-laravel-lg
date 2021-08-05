@php
$formAction = route('profiles.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('profiles.update', ['profile' => $item->user_id]);
    $formMethod = 'PUT';
}
@endphp

<!-- SHOW ERRORS -->
@include('partials/show_errors', ['formFor' => 'profile'])

<form action="{{ $formAction }}" method="post">
    {{ csrf_field() }}
    {{ method_field($formMethod) }}
    {!! Form::hidden('formFor_profile') !!}
    @if (isset($userId))
    {!! Form::hidden('userId', $userId) !!}
    @endif
    <div class="form-group row">
        {!! Form::label('fullname', 'Full name', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::text('fullname', old('fullname', $item->fullname), ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('phone', 'Phone', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::number('phone', old('phone', $item->phone), ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('address', 'address', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::text('address', old('address', $item->address), ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="{{ MyConfig::getSubmitContainerClass() }}">
            <button class="btn btn-primary " type="submit">Submit</button>
        </div>
    </div>

</form>
