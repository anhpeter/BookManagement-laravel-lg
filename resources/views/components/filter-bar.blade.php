<div class="d-flex  flex-column ">
    @foreach (MyConfig::getItemDataForController($controller, 'filter') as $field)
        @php
            $data = $filterData[$field];
        @endphp
        <!-- LABEL-->
        @if ($isSelectFilter($field) === false)
            @php
                $data = array_merge(['all' => 'All'], $data);
            @endphp
            <div class="mr-3 d-flex align-items-center my-1">
                <span class="filter-label">{{ $getLabel($field) }}</span>
                <div class="btn-group btn-group-sm ml-3" style="flex-wrap: wrap">
                    @foreach ($data as $key => $value)
                        @if ($key == 'all' || $getQty($field, $key) != 0)
                            <a class="btn btn-{{ $isSelected($field, $key) ? 'primary' : 'light' }}"
                                href="{{ $getFilterLink($field, $key) }}">
                                <span>{{ $value }}</span>
                                @if ($key !== 'all')
                                    <span class="badge badge-info">
                                        {{ $getQty($field, $key) }}
                                    </span>
                                @endif
                            </a>
                        @endif

                    @endforeach
                </div>
            </div>
        @else
            <div class="mr-3 d-flex align-items-center my-1">
                <span class="filter-label">{{ $getLabel($field) }}</span>
                <div class="ml-3">
                    {!! Form::select($field, $getSelectDataWithCount($field, $data), $filters[$field], ['class' => 'custom-select filter-select']) !!}
                </div>
            </div>
        @endif
    @endforeach
    <!-- 
    <div class="mr-3 d-flex align-items-center my-1">
        <span class="filter-label">GroupId</span>

        
    </div>
     -->

</div>
