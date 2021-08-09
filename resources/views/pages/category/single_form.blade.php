@php
$controller = 'category';
$formAction = route(MyHelper::toPlural($controller) . '.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route(MyHelper::toPlural($controller) . '.update', [$controller => $item->id]);
    $formMethod = 'PUT';
}

$formData = [
    [
        'name' => 'name',
        'value' => old('name', $item->name),
    ],
    [
        'name' => 'slug',
        'value' => old('slug', $item->slug),
    ],
    [
        'type' => 'select',
        'name' => 'status',
        'selectData' => $statusSelectData,
        'value' => old('stauts', $item->status),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="{{ $controller }}"></x-form>
