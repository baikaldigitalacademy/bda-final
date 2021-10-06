@extends( "layouts.app", [
  "title" => "Статусы (решения)",
  "icons" => true
] )

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

@section( "content" )
    <div id = "errorsDiv"></div>
    <h3>Справочник «Статусы (решения)»</h3>
    <fieldset>
        <legend>Новое значение:</legend>
        Название: <input data-create = "name" type = "text"> <br>
        <input id = "isColorEnabledCheckbox" type = "checkbox" onchange = "toggleIsColorInclude()">
        Цвет:
        <input id = "colorEnabledInput" data-create = "color" type = "color" style = "display: none">
        <span id = "colorDisabledSpan">нет</span>
        <br>
        <button onclick = "create( createSummaryStatusesRow )">Добавить</button>
    </fieldset>
    <div id = "data">
        @foreach( $data as $row )
            <div id = "row{{ $row->id }}">
                {{ $loop->index + 1 }}.
                <input data-edit{{ $row->id }} = "name" type = "text" value = "{{ $row->name }}">
                <input
                    id = "isColorEnabledCheckbox{{ $row->id }}"
                    type = "checkbox"
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
                <span
                    id = "colorDisabledSpan{{ $row->id }}"
                    @if( $row->color )
                        style = "display: none"
                    @endif
                >
                    нет
                </span>
                <button onclick = "update( {{ $row->id }} )">Сохранить</button>
                <button onclick = "destroy( {{ $row->id }} )">Удалить</button>
            </div>
        @endforeach
    </div>
@endsection
