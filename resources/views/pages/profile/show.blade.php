@extends('layouts/app1')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Infomation</h6>
            <div>
                <a href="{{ route('profiles.edit', ['profile' => $user->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit fa-fw"></i>
                    <span>Edit</span>
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm">
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
                        <div class="data-row">
                            <span class="label">Username</span>
                            <div class="value">{{ $user->username }}</div>
                        </div>
                        <div class="data-row">
                            <span class="label">Email</span>
                            <div class="value">{{ $user->email }}</div>
                        </div>
                        <div class="data-row">
                            <span class="label">Group</span>
                            <div class="value">Admin</div>
                        </div>
                        <div class="data-row">
                            <span class="label">Status</span>
                            <div class="value">
                                <h5> {!! ViewHelper::getStatusBadgeHtml($user->status) !!} </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PERSONAL INFO -->
                <div class="col-lg-6">
                    <div class="my-3">
                        <h3>Personal Infomation</h3>
                        <hr class="divider">
                    </div>
                    @if ($item != null)
                        <div class="data-box">
                            <div class="data-row">
                                <span class="label">Full name</span>
                                <div class="value">{{ $item->fullname }}</div>
                            </div>
                            <div class="data-row">
                                <span class="label">Address</span>
                                <div class="value">{{ $item->address }}</div>
                            </div>
                            <div class="data-row">
                                <span class="label">Phone</span>
                                <div class="value">{{ $item->phone }}</div>
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
