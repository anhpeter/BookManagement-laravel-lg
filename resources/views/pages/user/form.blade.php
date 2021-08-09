@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=>'Form',
    'color'=>'dark',
    'btnIcon'=>'fa-arrow-left',
    'btnContent'=>'Back',
    'btnLink'=> route('users.index'),
    ])

    <div class="row">
        <div class="offset-lg-3 col-lg-6 form-wrapper">
            @include('pages/user/single_form')
        </div>
    </div>

@endsection
