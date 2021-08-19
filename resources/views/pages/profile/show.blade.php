@extends('layouts/app1')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Infomation</h6>
            <div>
                @if ($item != null)
                    <a href="{{ route('profiles.edit', ['profile' => $user->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit fa-fw"></i>
                        <span>Edit</span>
                    </a>
                @endif
                <a href="{{ Auth::user()->hasRole(['admin']) ? route('users.index') : url()->previous() }}"
                    class="btn btn-dark btn-sm">
                    <i class="fas fa-arrow-left fa-fw"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- ACCOUNT -->
                <div class="col-lg-6">
                    <div class="my-3">
                        <h3>Account</h3>
                        <hr>
                    </div>
                    <div class="data-box">
                        {!! ViewHelper::getInfoDataRow('Username', $user->username) !!}
                        {!! ViewHelper::getInfoDataRow('Email', $user->email) !!}
                        {!! ViewHelper::getInfoDataRow('Group', 'Admin') !!}
                        {!! ViewHelper::getInfoDataRow('Status', sprintf('<h5>%s</h5>', ViewHelper::getStatusBadgeHtml($user->status))) !!}
                    </div>
                </div>

                <!-- PERSONAL INFO -->
                <div class="col-lg-6">
                    <div class="my-3">
                        <h3>Personal Infomation</h3>
                        <hr class="divider">
                    </div>
                    @if ($item != null)
                        <div class="d-flex align-items-lg-center justify-content-between justify-content-md-start">
                            @if ($item->avatar)
                                <div class="circle-picture order-1 order-md-0">
                                    <img src="{{ ViewHelper::getPhotoSrc($item->avatar, $controller) }}"
                                        class="img-fluid " />
                                </div>
                            @endif
                            <div class="data-box ml-3 order-0 order-md-1 ">
                                {!! ViewHelper::getInfoDataRow('Full name', $item->name) !!}
                                {!! ViewHelper::getInfoDataRow('Address', $item->address) !!}
                                {!! ViewHelper::getInfoDataRow('Phone', $item->phone) !!}
                                {!! ViewHelper::getInfoDataRow('Birthday', $item->birthday) !!}
                            </div>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('create-profile', ['userId' => $user->id]) }}"
                                class="btn btn-primary">Create
                                profile!</a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
@endsection
