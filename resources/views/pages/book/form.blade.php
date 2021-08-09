@php
$controller = 'book';
@endphp
@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=> Str::ucfirst($formType).' Form',
    'color'=>'dark',
    'btnIcon'=>'fa-arrow-left',
    'btnContent'=>'Back',
    'btnLink'=> route(MyHelper::toPlural($controller).'.index'),
    ])

    <div class="row">
        <div class="offset-lg-3 col-lg-6 form-wrapper">
            @include('pages/'.$controller.'/single_form')
        </div>
    </div>

@endsection
