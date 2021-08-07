@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    <x-page-heading title="Form" color="dark" btn-icon="fa-arrow-left" btn-content="Back"
        btn-link="{{ route('profiles.show', ['profile' => $user->id]) }}"></x-page-heading>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Account</h6>
                </div>
                <div class="card-body">
                    @include('pages/user/single_form', [ 'item'=>$user ])
                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card shadow-mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Personal infomation</h6>
                </div>
                <div class="card-body">
                    @include('pages/profile/single_form', [ 'item'=>$item ])
                </div>
            </div>

        </div>
    </div>
@endsection
