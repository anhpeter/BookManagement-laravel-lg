<div class="d-flex  flex-column ">
    @foreach (MyConfig::getItemDataForController($controller, 'filter') as $field)
        @php
            $data = array_merge(['all' => 'All'], $filterData[$field]);
        @endphp
        <!-- LABEL-->
        @if ($isSelectFilter($field, $data) === false)
            <div class="mr-3 d-flex align-items-center my-1">
                <span class="filter-label">{{ $getLabel($field) }}</span>
                <div class="btn-group btn-group-sm ml-3" style="flex-wrap: wrap">
                    @foreach ($data as $key => $value)
                        <a class="btn btn-{{ $isSelected($field, $key) ? 'primary' : 'light' }}"
                            href="{{ $getFilterLink($field, $key) }}">
                            <span>{{ $value }}</span>
                        </a>

                    @endforeach
                </div>
            </div>
        @else
            <div class="mr-3 d-flex align-items-center my-1">
                <span class="filter-label">{{ $getLabel($field) }}</span>
                <div class="ml-3">
                    {!! Form::select($field, $data, $filters[$field], ['class' => 'custom-select filter-select']) !!}
                </div>
            </div>
        @endif
    @endforeach
    <div class="mr-3  my-1 d-flex">
        <div>
            <span class="filter-label">Created start</span>
            <div> {!! Form::date('created_at_end', null, ['class' => 'form-control my-1']) !!} </div>
        </div>
        <div class="ml-lg-2">
            <span class="filter-label">Created end</span>
            <div> {!! Form::date('created_at_end', null, ['class' => 'form-control my-1']) !!} </div>
        </div>
    </div>
</div>
