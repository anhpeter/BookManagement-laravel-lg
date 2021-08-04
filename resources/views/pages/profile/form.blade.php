@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=>'Form',
    'color'=>'dark',
    'btnIcon'=>'fa-back',
    'btnContent'=>'Back',
    'btnLink'=> route('profiles.show', ['profile'=>$userId]),
    ])

    <div class="row">
        <div class="offset-lg-3 col-lg-6 form-wrapper">
            @include('pages/profile/single-form')
        </div>
    </div>

@endsection
