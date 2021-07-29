@extends('layouts/app1')
@section('content')
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Book List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg ">
                <table class="table  table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td class="d-flex">
                                <div class="book-picture">
                                    <img src="https://dangchiviet.com/wp-content/uploads/2019/07/review-sach-nha-gia-kim.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="flex-1 ml-2">
                                    Nha gia kim
                                </div>
                            </td>
                            <td>Paulo Coelho</td>
                            <td>Novel</td>
                            <td>100.000 d</td>
                            <td>
                                <div>
                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td class="d-flex">
                                <div class="book-picture">
                                    <img src="https://dangchiviet.com/wp-content/uploads/2019/07/review-sach-nha-gia-kim.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="flex-1 ml-2">
                                    Nha gia kim
                                </div>
                            </td>
                            <td>Paulo Coelho</td>
                            <td>Novel</td>
                            <td>100.000 d</td>
                            <td>
                                <div>
                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td class="d-flex">
                                <div class="book-picture">
                                    <img src="https://dangchiviet.com/wp-content/uploads/2019/07/review-sach-nha-gia-kim.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="flex-1 ml-2">
                                    Nha gia kim
                                </div>
                            </td>
                            <td>Paulo Coelho</td>
                            <td>Novel</td>
                            <td>100.000 d</td>
                            <td>
                                <div>
                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">1</th>
                            <td class="d-flex">
                                <div class="book-picture">
                                    <img src="https://dangchiviet.com/wp-content/uploads/2019/07/review-sach-nha-gia-kim.jpg"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="flex-1 ml-2">
                                    Nha gia kim
                                </div>
                            </td>
                            <td>Paulo Coelho</td>
                            <td>Novel</td>
                            <td>100.000 d</td>
                            <td>
                                <div>
                                    <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
