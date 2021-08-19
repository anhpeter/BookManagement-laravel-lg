@php
$controller = 'book';
$formAction = route(MyHelper::toPlural($controller) . '.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route(MyHelper::toPlural($controller) . '.update', [$controller => $item->id]);
    $formMethod = 'PUT';
}

$formData = [
    [
        'type' => 'hidden',
        'name' => 'current_picture',
        'value' => old('current_picture', $item->picture),
    ],
    [
        'name' => 'title',
        'value' => old('title', $item->title),
    ],
    [
        'name' => 'slug',
        'value' => old('slug', $item->slug),
    ],
    [
        'type' => 'number',
        'name' => 'price',
        'value' => old('price', $item->price),
    ],
    [
        'type' => 'number',
        'name' => 'discount',
        'value' => old('discount', $item->discount),
    ],
    [
        'type' => 'select',
        'name' => 'status',
        'selectData' => $statusSelectData,
        'value' => old('stauts', $item->status),
    ],
    [
        'type' => 'select',
        'name' => 'author_id',
        'selectData' => $authorSelectData,
        'value' => old('author_id', $item->author_id),
    ],
    [
        'type' => 'select',
        'name' => 'category_id',
        'selectData' => $categorySelectData,
        'value' => old('category_id', $item->category_id),
    ],
    [
        'type' => 'textarea',
        'name' => 'short_description',
        'value' => old('short_description', $item->short_description),
    ],
    [
        'type' => 'textarea',
        'name' => 'long_description',
        'value' => old('long_description', $item->long_description),
    ],
    [
        'type' => 'picture',
        'name' => 'picture',
        'hasPicture' => true,
        'hasCropModal' => true,
        'value' => old('picture', $item->picture),
        'pictureSrc' => ViewHelper::getPhotoSrc(old('picture', $item->picture), $controller),
    ],
    [
        'type' => 'submit',
        'name' => 'submit',
    ],
];
@endphp
<x-form :method="$formMethod" :action="$formAction" :formData="$formData" form-for="{{ $controller }}"></x-form>
