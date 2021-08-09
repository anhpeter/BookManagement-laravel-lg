<form action="/" method="post" class="search-form">
    <div class="input-group search-bar">
        <div class="input-group-prepend">
            <button class="btn-search-type btn btn-outline-secondary dropdown-toggle" type="button"
                data-toggle="dropdown"
                data-name="{{ $search['field'] }}">{{ $searchData[$search['field']] }}</button>
            <div class="dropdown-menu">
                @foreach ($searchData as $key => $value)
                    <button type="button" class="dropdown-item"
                        data-name="{{ $key }}">{{ $value }}</button>
                @endforeach
            </div>
        </div>
        <input type="text" class="form-control bg-light border-0 small search-input" placeholder="Search ..."
            value="{{ $search['value'] }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"> <i class="fas fa-search fa-sm"></i> </button>
        </div>
    </div>
</form>
