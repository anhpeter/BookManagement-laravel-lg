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
                        {!! ViewHelper::getInfoDataRow('Name', $item->user->profile->name) !!}
                        {!! ViewHelper::getInfoDataRow('Username', $item->user->username) !!}
                        {!! ViewHelper::getInfoDataRow('Email', $item->user->email) !!}
                        {!! ViewHelper::getInfoDataRow('Phone', $item->user->profile->phone) !!}
                        {!! ViewHelper::getInfoDataRow('Address', $item->user->profile->address) !!}
                        {!! ViewHelper::getInfoDataRow('Group', Str::ucfirst($item->user->group->name)) !!}
                    </div>
                </div>

                <!-- ORDER INFO -->
                <div class="col-lg-8">
                    <div class="my-3">
                        <h3>Order Detail - <span class="text-primary">#{{ $item->id }}</span></h3>
                        <hr class="divider" />
                        <form action="{{ route('orders.update', ['order' => $item->id]) }}" method="post"
                            class="data-box">
                            @csrf
                            @method('put')
                            {!! ViewHelper::getInfoDataRow('Status', Form::select('status', MyConfig::getSelectData('status', $controller), $item->status, ['class' => 'custom-select update-select'])) !!}
                            <div class="data-row align-items-center">
                                <span class="label"></span>
                                <div class="value">
                                    <x-checkbox label="Send email" name="send-email" value="true" isChecked="false">
                                    </x-checkbox>
                                </div>
                            </div>
                            <div class="data-row ">
                                <span class="label"></span>
                                <div class="value text-right">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>

                        <div class="data-box">
                            {!! ViewHelper::getInfoDataRow('Shipping method', ViewHelper::getStatusBadgeHtml($item->shipping_method, 'shipping_method')) !!}
                            {!! ViewHelper::getInfoDataRow('payment method', ViewHelper::getStatusBadgeHtml($item->payment_method, 'payment_method')) !!}
                            {!! ViewHelper::getInfoDataRow('Phone', $item->phone) !!}
                            {!! ViewHelper::getInfoDataRow('Note', $item->note) !!}
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
