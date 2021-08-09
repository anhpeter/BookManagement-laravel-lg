<div class="d-flex  flex-column ">
    <div class="mr-3 d-flex align-items-center my-1">
        @foreach ($filterData as $field => $data)
            <!-- LABEL-->
            <span class="filter-label">{{ $field }}</span>
            <div class="btn-group btn-group-sm ml-3">
                @foreach ($data as $key => $value)
                    <a class="btn btn-{{ $isSelected($field, $key) ? 'primary' : 'light' }}"
                        href="{{ $getFilterLink($field, $key) }}">
                        <span>{{ $value['content'] }}</span>
                        @if ($key !== 'all')
                            <span class="badge badge-info ml-2">{{ $getQty($field, $key) }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
    <!-- 
    <div class="mr-3 d-flex align-items-center my-1">
        <span class="filter-label">GroupId</span>

        <div class="ml-3">
            <select name="groupId" class="custom-select filter-select">
                <option value="all">All </option>
                <option value="3">Editor (4)</option>
                <option value="1">Admin (2)</option>
            </select>
        </div>
    </div>
     -->

</div>
