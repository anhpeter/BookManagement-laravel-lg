<!-- FILTER AND SEARCH -->
@if ($hasFilterOrSearch())
    <div class="row px-3 py-2">
        @if ($hasFilter())
            <div class="col-lg-6">
                <x-filter-bar :controller="$controller" :filters="$pageParams['filters']"
                    :filter-data="$pageParams['filterData']" :count-filters="$countFilters"></x-filter-bar>
            </div>
        @endif
        @if ($hasSearch())
            <div class="col-lg-6 {{ $hasFilter() ? 'd-flex justify-content-end' : '' }} ">
                <x-search-bar :search="$pageParams['search']" :search-data="$pageParams['searchData']"></x-search-bar>
            </div>
        @endif
    </div>
@endif


<!-- TABLE -->
<div>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <!-- NO COL -->
                    <th scope="col">#</th>

                    <!-- OTHER COLS -->
                    @foreach ($theadData as $key => $column)
                        <th>{!! $getThLabel($column) !!}</th>
                    @endforeach

                    <!-- ACTION COL -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tbodyData as $key => $row)
                    @php
                        $rowArr = MyHelper::convertStdClassToArray($row);
                        $no = $key + 1;
                    @endphp
                    <tr>

                        <!-- NO COL -->
                        <th scope="row">{{ $no }}</th>

                        <!-- OTHER COLS -->
                        @foreach ($theadData as $key => $column)
                            @php
                                $value;
                                if (isset($column['value'])) {
                                    $value = $column['value']($row);
                                } else {
                                    $value = $getTdValue($column['field'], $rowArr[$column['field']]);
                                }
                            @endphp
                            <td>
                                @switch($column['field'])
                                    @case('status')
                                        <x-status :controller="$controller" :id="$rowArr['id']" :value="$value"></x-status>
                                    @break
                                    @default
                                        {!! $value !!}
                                @endswitch
                            </td>
                        @endforeach

                        <!-- ACTION  COL-->
                        <td>
                            <x-item-action-bar :controller="$controller" :id="$rowArr['id']"
                                :name="$getNameValue($rowArr)">
                            </x-item-action-bar>
                        </td>
                    </tr>

                    <!-- EMPTY MESSAGE -->
                    @empty
                        <tr>
                            <td colspan="1000">
                                <x-alert type="info" message="No items for display!"></x-alert>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- DELETE ITEM MODAL -->
        @include('partials/delete_item_modal')
    </div>
