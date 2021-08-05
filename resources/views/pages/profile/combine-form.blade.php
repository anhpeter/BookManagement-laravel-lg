@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=>'Form',
    'color'=>'dark',
    'btnIcon'=>'fa-arrow-left',
    'btnContent'=>'Back',
    'btnLink'=> route('profiles.show', ['profile'=>$user->id]),
    ])

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
