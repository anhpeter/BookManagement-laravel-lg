<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <!-- NO COL -->
                <th scope="col">#</th>

                <!-- OTHER COLS -->
                @foreach ($theadData as $key => $column)
                    <th>{{ $getThLabel($column) }}</th>
                @endforeach

                <!-- ACTION COL -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tbodyData as $key => $row)
                @php
                    $row = MyHelper::convertStdClassToArray($row);
                    $no = $key + 1;
                @endphp
                <tr>

                    <!-- NO COL -->
                    <th scope="row">{{ $no }}</th>

                    <!-- OTHER COLS -->
                    @foreach ($theadData as $key => $column)
                        @php
                            $value = $row[$column['field']];
                        @endphp
                        <td>
                            @switch($column['field'])
                                @case('status')
                                    <x-status :controller="$controller" :id="$row['id']" :value="$value"></x-status>
                                @break
                                @default
                                    {{ $value }}
                            @endswitch
                        </td>
                    @endforeach

                    <!-- ACTION  COL-->
                    <td>
                        <x-item-action-bar :controller="$controller" :id="$row['id']" :name="$getNameValue($row)">
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
    @include('partials/delete_item_modal')
