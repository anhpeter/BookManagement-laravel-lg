@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=>'User List',
    'color'=>'primary',
    'btnIcon'=>'fa-plus',
    'btnContent'=>'Add',
    'btnLink'=>'/admin/user/form',
    ])

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
                            <th>Fullname</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($items as $key => $item)
                            @php

                                $no = $key + 1;
                                $status = MyHelper::getStatusHtml($controller, $item->id, $item->status);
                                //$status = MyHelper::getStatusHtml($controller, $item->id, );
                            @endphp
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>
                                    <div class="avatar-username">
                                        <span><img
                                                src="https://media-cdn.laodong.vn/storage/newsportal/2021/2/26/883735/Jennie-1-1598428156.jpg?w=414&h=276&crop=auto&scale=both"
                                                alt=""></span>
                                        <span>{{ $item->username }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>
                                    {!! $status !!}
                                </td>
                                <td>
                                    <div>
                                        <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
