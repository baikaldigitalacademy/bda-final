@extends( "layouts.admin", [ "title" => "Статусы (решения)" ] )

@push( "scripts" )
    <script>
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const BASE_URL = "/summary_statuses";
        let totalCount = {{ $data->count() }};
    </script>

    <script src = "{{ asset( "js/directories/successCallbacks.js" ) }}"></script>
    <script src = "{{ asset( "js/directories/simple.js" ) }}"></script>
    <script src = "{{ asset( "js/directories/summaryStatuses.js" ) }}"></script>
@endpush

@section( "content-admin" )
    <div class = "p-4">
        <h3>Справочник «Статусы (решения)»</h3>
        <div id = "errorsDiv" class = "alert alert-danger d-none"></div>
        <label for = "name">Новое значение</label>
        <input id = "name" data-create = "name" type = "text" class = "form-control" placeholder = "название">
        <div class = "mt-3">
            <input
                id = "isColorEnabledCheckbox"
                type = "checkbox"
                class = "form-check-input"
                onchange = "toggleIsColorInclude()"
            >
            <label for = "isColorEnabledCheckbox">Цвет:</label>
            <input
                id = "colorEnabledInput"
                data-create = "color"
                data-null = "true"
                type = "color"
                style = "display: none"
            >
            <span id = "colorDisabledSpan">нет</span>
        </div>
        <button onclick = "create( createSummaryStatusesRow )" class = "btn btn-primary mt-3">Добавить</button>
        <div id = "data" class = "mt-3">
            @foreach( $data as $row )
                <div id = "row{{ $row->id }}" class = "d-flex align-items-center mb-2">
                    <input
                        data-edit{{ $row->id }} = "name"
                        type = "text"
                        class = "form-control"
                        value = "{{ $row->name }}"
                    >
                    <input
                        id = "isColorEnabledCheckbox{{ $row->id }}"
                        type = "checkbox"
                        class = "form-check-input ms-2 me-2"
                        style = "padding: 5px"
                        onchange = "toggleIsColorInclude( {{ $row->id }} )"
                        @if( $row->color ) checked @endif
                    >
                    <input
                        id = "colorEnabledInput{{ $row->id }}"
                        data-edit{{ $row->id }} = "color"
                        type = "color"
                        @if( $row->color )
                            value = "{{ $row->color }}"
                        @else
                            data-null = "true"
                            style = "display: none"
                        @endif
                    >
                    <label
                        id = "colorDisabledSpan{{ $row->id }}"
                        for = "isColorEnabledCheckbox{{ $row->id }}"
                        @if( $row->color )
                            style = "display: none"
                        @endif
                    >
                        нет
                    </label>
                    <button onclick = "update( {{ $row->id }} )" class = "btn btn-success ms-2">
                        <i class = "fas fa-check"></i>
                    </button>
                    <button onclick = "destroy( {{ $row->id }} )" class = "btn btn-danger ms-2">
                        <i class = "fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
