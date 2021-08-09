@php
$controller = 'user';
$formAction = route(MyHelper::toPlural($controller) . '.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route(MyHelper::toPlural($controller) . '.update', [$controller => $item->id]);
    $formMethod = 'PUT';
}

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
        'selectData' => $statusSelectData,
        'value' => old('stauts', $item->status),
    ],
    [
        'type' => 'select',
        'name' => 'group_id',
        'selectData' => $groupSelectData,
        'value' => old('group_id', $item->group_id),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="{{$controller}}"></x-form>
