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
                            <!--
                                                                                                                                                                                            <th>Group</th>
                                                                                                                                                                                            -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $key => $item)
                            @php
                                
                                $no = $key + 1;
                                $status = ViewHelper::getStatusHtml($controller, $item->id, $item->status);
                            @endphp
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>
                                    {{ $item->username }}
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{!! $status !!}</td>
                                <td>
                                    <div class="action-container">
                                        <a href="{{ route('profiles.show', ['profile' => $item->id]) }}"
                                            class="btn btn-info btn-sm" data-toggle="tooltip" title="View profile">
                                            <i class="fas fa-info fa-fw"></i>
                                        </a>
                                        <a href="{{ route('users.edit', ['user' => $item->id]) }}" data-toggle="tooltip"
                                            class="btn btn-success btn-sm" title="Edit">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                        <form class="delete-item-form"
                                            action="{{ route('users.destroy', ['user' => $item->id]) }}" method="post"
                                            data-item-name="{{ $item->username }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="delete">
                                                <i class="fas fa-trash-alt fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
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
