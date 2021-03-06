@extends('layouts/app1')
@section('content')
    @php
    $options = ['nameField' => 'title', 'hasFilter' => true, 'hasSearch' => true, 'hasSort' => true];
    $theadData = [
        ['field' => 'title'],
        [
            'field' => 'author_id',
            'label' => 'Author',
            'value' => function ($item) {
                return $item->author->name;
            },
        ],
        [
            'field' => 'category_id',
            'label' => 'Category',
            'value' => function ($item) {
                return $item->category->name;
            },
        ],
        [
            'field' => 'price',
            'value'=>function($item){
                return MyHelper::priceFormat($item->price);
            }
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
