@extends('layouts/app1')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Infomation</h6>
            <div>
                <a href="{{ route('orders.index') }}" class="btn btn-dark btn-sm">
                    <i class="fas fa-arrow-left fa-fw"></i>
                    <span>Back</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- ACCOUNT -->
                <div class="col-lg-4">
                    <div class="my-3">
                        <h3>Customer Information</h3>
                        <hr class="divider">
                    </div>
                    <div class="data-box">
                        {!! ViewHelper::getInfoDataRow('Username', $item->user->username) !!}
                        {!! ViewHelper::getInfoDataRow('Email', $item->user->email) !!}
                        {!! ViewHelper::getInfoDataRow('Group', $item->user->group->name) !!}
                    </div>
                </div>

                <!-- ORDER INFO -->
                <div class="col-lg-8">
                    <div class="my-3">
                        <h3>Order Detail</h3>
                        <hr class="divider">
                    </div>
                    <form action="{{ route('orders.status', ['order' => $item->id]) }}" method="post" class="data-box">
                        @csrf
                        {!! ViewHelper::getInfoDataRow('Status', Form::select('status', MyConfig::getSelectData('status', 'order'), $item->status, ['class' => 'custom-select update-select'])) !!}
                    </form>
                    <div class="data-box">
                        {!! ViewHelper::getInfoDataRow('Phone', $item->phone) !!}
                        {!! ViewHelper::getInfoDataRow('Address', $item->address) !!}
                        <div class="mt-4">
                            <x-order-cart :order="$item" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
