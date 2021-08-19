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
        'name' => 'name',
        'value' => old('name', $item->name),
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
        'pictureSrc' => ViewHelper::getPhotoSrc(old('avatar', $item->avatar), $controller),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
if ($formType === 'add') {
    array_push($formData, [
        'type' => 'hidden',
        'name' => 'userId',
        'value' => $userId,
    ]);
}
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="profile"></x-form>
