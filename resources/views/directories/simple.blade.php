@extends( "layouts.admin", [ "title" => $directoryName ] )

@push( "scripts" )
    <script>
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const BASE_URL = "{{ $baseUrl }}";
        let totalCount = {{ $data->count() }};
    </script>

    <script src = "{{ asset( "js/directories/successCallbacks.js" ) }}"></script>
    <script src = "{{ asset( "js/directories/simple.js" ) }}"></script>
@endpush

@section( "content-admin" )
    <div class = "p-4">
        <h3>Справочник «{{ $directoryName }}»</h3>
        <div id = "errorsDiv" class = "alert alert-danger d-none"></div>
        <label for = "name">Новое значение</label>
        <input data-create = "name" type = "text" id = "name" class = "form-control">
        <button onclick = "create( createNameRow )" class = "btn btn-primary mt-2">Добавить</button>
        <div id = "data" class = "mt-3">
            @foreach( $data as $row )
                <div id = "row{{ $row->id }}" class = "d-flex mt-2">
                    <input
                        data-edit{{ $row->id }} = "name"
                        type = "text"
                        value = "{{ $row->name }}"
                        class = "form-control me-2"
                    >
                    <button class = "btn btn-success me-2" onclick = "update( {{ $row->id }} )">
                        <i class = "fas fa-check"></i>
                    </button>
                    <button class = "btn btn-danger" onclick = "destroy( {{ $row->id }} )">
                        <i class = "fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
