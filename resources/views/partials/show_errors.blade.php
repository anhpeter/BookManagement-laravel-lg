@php
$formFor = $formFor ?? $controller;
$isShowError = array_key_exists('formFor_' . $formFor, old());
@endphp
@if ($isShowError && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
