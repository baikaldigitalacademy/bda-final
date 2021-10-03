@extends( "layouts.app", [
  "title" => $directoryName,
  "icons" => true
] )

@push( "scripts" )
    <script>
        const BASE_URL = "{{ $baseUrl }}";
    </script>

    <script src = "{{ asset( "js/simple_directory.js" ) }}"></script>
@endpush

@section( "content" )
    <h3>Справочник «{{ $directoryName }}»</h3>
    Новое значение:
    <input id = "newNameInput" type = "text">
    <button id = "addNewNameButton">Добавить</button>
    <div id = "data">
        @foreach( $data as $row )
            <div>
                {{ $loop->index + 1 }}.
                <input id = "name{{ $row->id }}Input" type = "text" value = "{{ $row->name }}">
                <button onclick = "updateName( {{ $row->id }} )">Сохранить</button>
                <button onclick = "deleteItem( {{ $row->id }} )">Удалить</button>
            </div>
        @endforeach
    </div>
@endsection
