@extends('layouts/app1')
@section('content')
    @php
    $options = ['nameField' => 'username'];
    $theadData = [['field' => 'username'], ['field' => 'email'], ['field' => 'status']];
    $tbodyData = $items;
    @endphp

    <!-- Page Heading -->
    <x-page-heading title="User" color="primary" btn-icon="fa-plus" btn-content="add"
        btn-link="{{ route('users.create') }}"></x-page-heading>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <x-management-table :controller="$controller" :thead-data="$theadData" :tbody-data="$tbodyData"
                :options="$options">
            </x-management-table>
        </div>
    </div>
@endsection
