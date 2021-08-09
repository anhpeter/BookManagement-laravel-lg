<div class="d-flex  flex-column ">
    @foreach ($filterData as $field => $data)
        <!-- LABEL-->
        @if ($isSelectFilter($field) === false)
            <div class="mr-3 d-flex align-items-center my-1">
                <span class="filter-label">{{ $getLabel($field) }}</span>
                <div class="btn-group btn-group-sm ml-3">
                    @foreach ($data as $key => $value)
                        <a class="btn btn-{{ $isSelected($field, $key) ? 'primary' : 'light' }}"
                            href="{{ $getFilterLink($field, $key) }}">
                            <span>{{ $value }}</span>
                            @if ($key !== 'all')
                                <span class="badge badge-info">
                                    {{ $getQty($field, $key) }}
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            @php
                $selectDataWithCount = $getSelectDataWithCount($field, $data);
            @endphp
            @if (count($selectDataWithCount) > 0)
                <div class="mr-3 d-flex align-items-center my-1">
                    <span class="filter-label">{{ $getLabel($field) }}</span>
                    <div class="ml-3">
                        {!! Form::select($field, $selectDataWithCount, $filters[$field], ['class' => 'custom-select']) !!}
                    </div>
                </div>
            @endif
        @endif
    @endforeach
    <!-- 
    <div class="mr-3 d-flex align-items-center my-1">
        <span class="filter-label">GroupId</span>

        
    </div>
     -->

</div>
