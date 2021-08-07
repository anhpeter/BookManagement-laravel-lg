@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    <x-page-heading title="User" color="primary" btn-icon="fa-plus" btn-content="add"
        btn-link="{{ route('users.create') }}"></x-page-heading>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $key => $item)
                            @php
                                
                                $no = $key + 1;
                            @endphp
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>
                                    {{ $item->username }}
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <x-status :controller="$controller" :id="$item->id" :value="$item->status"></x-status>
                                </td>
                                <td>
                                    <x-item-action-bar :controller="$controller" :id="$item->id" :name="$item->username">
                                    </x-item-action-bar>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="1000">
                                    <div class="alert alert-primary" role="alert">
                                        No items for display!
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('partials/delete_item_modal')
@endsection
