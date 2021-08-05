@php
$formAction = route('profiles.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('profiles.update', ['profile' => $user->id]);
    $formMethod = 'PUT';
}
@endphp

<!-- SHOW ERRORS -->
@include('partials/show_errors', ['formFor' => 'profile'])

<form action="{{ $formAction }}" method="post">
    {{ csrf_field() }}
    {{ method_field($formMethod) }}
    {!! Form::hidden('formFor_profile') !!}
    {!! Form::hidden('current_avatar', $item->avatar) !!}

    <!-- FORM FOR -->
    {!! Form::hidden('formFor', 'profile') !!}
    <!-- FORM FOR -->

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
        {!! Form::label('birthday', 'birthday', ['class' => MyConfig::getFormLabelClass()]) !!}
        <div class="{{ MyConfig::getFormInputContainerClass() }}">
            {!! Form::date('birthday', old('birthday', $item->birthday), ['class' => MyConfig::getFormInputClass('text'), 'max' => '2010-01-01']) !!}
        </div>
    </div>

    <!-- PICTURE -->
    <div class="form-group row">
        <label for="image-file-input" class="col-lg-2 col-form-label">Avatar</label>
        <div class="col-lg-10">
            <div>
                <input id="image-file-input" type="file" class="custom-file-input d-none" accept=".png,.jpg">
                <input type="hidden" name="avatar" id="image-text-input" value="" />
            </div>
            <div class="img-container img-container-circle mt-3 position-relative"
                style="width: 200px; height:200px; border-radius: 100px; overflow:hidden">
                <img src="{{ old('avatar', ViewHelper::getAvatarPath($item->avatar)) }}"
                    class="img-fluid form-image" />
                <div class="edit-image-btn rounded rounded-circle"><span class="fas fa-image fa-4x text-light"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="{{ MyConfig::getSubmitContainerClass() }}">
            <button class="btn btn-primary " type="submit">Submit</button>
        </div>
    </div>

    @include('partials/crop_picture_modal')
</form>
