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
                            <!--
                                                                        <th>Group</th>
                                                                        -->
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
                                    <div class="d-flex align-items-center">
                                        <div class="circle-avatar">
                                            <img src="https://img.i-scmp.com/cdn-cgi/image/fit=contain,width=425,format=auto/sites/default/files/styles/768x768/public/images/methode/2019/01/16/07a7ab2a-17ce-11e9-8ff8-c80f5203e5c9_image_hires_160333.jpg?itok=SYxUEfvx&amp;v=1547625814"
                                                alt="" class="img-fluid">
                                        </div>
                                        <div class="ml-3">
                                            <div>
                                                <b>Username: </b>
                                                <span>{{ $item->username }}</span>
                                            </div>
                                            <div>
                                                <b>Full name: </b>
                                                <span>{{ $item->fullname }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $item->email }}</td>
                                <!--
                                                                    <td>
                                                                        <select class="custom-select" id="groupId" name="groupId"><option value="1">admin</option>
                                                                        <option value="2">member</option>
                                                                        </select>
                                                                    </td>
                                                                    -->
                                <td>{!! $status !!}</td>
                                <td>
                                    <div class="action-container">
                                        <a href="{{ route('users.edit', ['user' => $item->id]) }}"
                                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="/Admin/User/Delete/6" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
