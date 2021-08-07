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

$formData = [
    [
        'name' => 'username',
        'value' => old('username', $item->username),
    ],
    [
        'type' => 'email',
        'name' => 'email',
        'value' => old('email', $item->email),
    ],
    [
        'type' => 'password',
        'name' => 'password',
        'value' => old('password', $item->password),
    ],
    [
        'type' => 'select',
        'name' => 'status',
        'selectData' => $statusSelectItems,
        'value' => old('stauts', $item->status),
    ],
    [
        'type' => 'select',
        'name' => 'group_id',
        'selectData' => $groupSelectItems,
        'value' => old('group_id', $item->group_id),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="user"></x-form>
