@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    <x-page-heading title="Form" color="dark" btn-icon="fa-arrow-left" btn-content="Back"
        btn-link="{{ route('profiles.show', ['profile' => $userId]) }}"></x-page-heading>

    <div class="row">
        <div class="offset-lg-3 col-lg-6 form-wrapper">
            @include('pages/profile/single_form')
        </div>
    </div>

@endsection
