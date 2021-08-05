@php
$formAction = route('users.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('users.update', ['user' => $item->id]);
    $formMethod = 'PUT';
}

$statusSelectItems = [
    'active' => 'Active',
    'inactive' => 'In active',
];
$groupSelectItems = [
    '1' => 'Admin',
    '2' => 'Member',
    '3' => 'Editor',
];
@endphp

<!-- SHOW ERRORS -->
@include('partials/show_errors', ['formFor' => 'user'])

<form action="{{ $formAction }}" method="post">
    {{ csrf_field() }}
    {{ method_field($formMethod) }}

    <div class="form-group row">
        {!! Form::label('username', 'Username', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::text('username', old('username', $item->username), ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('email', 'Email', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::text('email', old('email', $item->email), ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('password', 'Password', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::password('password', ['class' => MyConfig::getFormInputClass('text')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('status', 'Status', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::select('status', $statusSelectItems, old('status', $item->status), ['class' => MyConfig::getFormInputClass('select')]) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('group_id', 'Group', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::select('group_id', $groupSelectItems, old('group_id', $item->group_id), ['class' => MyConfig::getFormInputClass('select')]) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="{{ MyConfig::getSubmitContainerClass() }}">
            <button class="btn btn-primary " type="submit">Submit</button>
        </div>
    </div>

</form>
