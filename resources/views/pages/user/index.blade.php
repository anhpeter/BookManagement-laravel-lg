@extends('layouts/app1')
@section('content')
    @php
    $options = ['nameField' => 'username', 'hasFilter' => true, 'hasSearch' => true, 'hasSort' => true];
    $theadData = [
        ['field' => 'username'],
        ['field' => 'email'],
        [
            'field' => 'group_id',
            'label' => 'Group',
            'value' => function ($item) {
                return Str::ucfirst($item->group->name) ;
            },
        ],
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
    <x-page-heading title="{{ ucfirst($controller) }}" color="primary" btn-icon="fa-plus" btn-content="Add"
        btn-link="{{ route(MyHelper::toPlural($controller) . '.create') }}"></x-page-heading>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <x-management-table :controller="$controller" :thead-data="$theadData" :tbody-data="$tbodyData"
                :options="$options" :page-params="$pageParams" :count-filters="$countFilters">
            </x-management-table>
            <x-pagination :paginator="$items"></x-pagination>
        </div>
    </div>
@endsection
