@extends('layouts/app1')
@section('content')
    @php
    $options = ['nameField' => 'username', 'hasFilter' => true, 'hasSearch' => true, 'hasSort' => true];
    $theadData = [
        ['field' => 'username'],
        ['field' => 'email'],
        ['field' => 'status'],
        [
            'field' => 'created_at',
            'label' => 'Created',
            'type' => 'time',
        ],
    ];
    $tbodyData = $items;
    @endphp

    <!-- Page Heading -->
    <x-page-heading title="User" color="primary" btn-icon="fa-plus" btn-content="add"
        btn-link="{{ route('users.create') }}"></x-page-heading>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <x-management-table :controller="$controller" :thead-data="$theadData" :tbody-data="$tbodyData"
                :options="$options" :page-params="$pageParams" :count-filters="$countFilters">
            </x-management-table>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-end">
                {{ $items->withQueryString()->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
