@extends( "layouts.app", [
  "title" => $directoryName,
  "icons" => true
] )

@push( "scripts" )
    <script>
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const BASE_URL = "{{ $baseUrl }}";
        let totalCount = {{ $data->count() }};
    </script>

    <script src = "{{ asset( "js/directories/successCallbacks.js" ) }}"></script>
    <script src = "{{ asset( "js/directories/simple.js" ) }}"></script>
@endpush

@section( "content" )
    <div id = "errorsDiv"></div>
    <h3>Справочник «{{ $directoryName }}»</h3>
    Новое значение:
    <input data-create = "name" type = "text">
    <button onclick = "create( createNameRow )">Добавить</button>
    <div id = "data">
        @foreach( $data as $row )
            <div id = "row{{ $row->id }}">
                {{ $loop->index + 1 }}.
                <input data-edit{{ $row->id }} = "name" type = "text" value = "{{ $row->name }}">
                <button onclick = "update( {{ $row->id }} )">Сохранить</button>
                <button onclick = "destroy( {{ $row->id }} )">Удалить</button>
            </div>
        @endforeach
    </div>
@endsection
