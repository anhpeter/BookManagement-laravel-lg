@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->
    @include('partials/page_heading', [
    'title'=>'Form',
    'color'=>'dark',
    'btnIcon'=>'fa-back',
    'btnContent'=>'Back',
    'btnLink'=> route('users.index'),
    ])

    <div class="row">
        <div class="offset-lg-3 col-lg-6 form-wrapper">
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="username">Username</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="username" name="username" type="text"
                            value="{{ $item->username }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="email">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="email" name="email" type="email" value="{{ $item->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="fullname">Fullname</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="fullname" name="fullname" type="text"
                            value="{{ $item->fullname }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="status">Status</label>
                    <div class="col-lg-10">
                        <select class="custom-select" id="status" name="status">
                            <option selected="selected" value="active">Active</option>
                            <option value="inactive">In active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="groupId">Group</label>
                    <div class="col-lg-10">
                        <select class="custom-select" id="groupId" name="groupId">
                            <option selected="selected" value="1">admin</option>
                            <option value="2">member</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="phone">Phone</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="phone" name="phone" type="number" value="{{ $item->phone }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="address">Address</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="address" name="address" type="text" value="{{ $item->address }}">
                    </div>
                </div>
                <!--
                    <div class="form-group row">
                        <label for="avatar" class="col-lg-2 col-form-label">Avatar</label>
                        <div class="col-lg-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                <label class="custom-file-label" for="avatar">Choose file</label>
                            </div>
                            <div class="image-container mt-3">
                                <img src="Model.item.avatar" alt="Avatar" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    -->
                <div class="form-group row">
                    <div class="offset-lg-2 d-flex justify-content-end col-md-10">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection
