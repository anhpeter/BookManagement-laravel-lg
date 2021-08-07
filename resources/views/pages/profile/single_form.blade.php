@php
$formAction = route('profiles.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('profiles.update', ['profile' => $user->id]);
    $formMethod = 'PUT';
}
$formData = [
    [
        'type' => 'hidden',
        'name' => 'current_avatar',
        'value' => old('current_avatar', $item->avatar),
    ],
    [
        'name' => 'fullname',
        'value' => old('fullname', $item->fullname),
    ],
    [
        'type' => 'number',
        'name' => 'phone',
        'value' => old('phone', $item->phone),
    ],
    [
        'name' => 'address',
        'value' => old('address', $item->address),
    ],
    [
        'type' => 'date',
        'name' => 'birthday',
        'value' => old('birthday', $item->birthday),
    ],
    [
        'type' => 'picture',
        'name' => 'avatar',
        'hasPicture' => true,
        'hasCropModal' => true,
        'value' => old('avatar', $item->avatar),
        'pictureSrc' => ViewHelper::getAvatarPath(old('avatar', $item->avatar)),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="profile"></x-form>
