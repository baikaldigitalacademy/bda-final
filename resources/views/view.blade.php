@extends( "layouts.app", [ "title" => $data->name ] )

@push( "scripts" )
    <script>
        const CSRF_TOKEN = "{{ csrf_token() }}";
        const DASHBOARD_URL = "{{ route( "dashboard" ) }}";
    </script>

    <script src = "{{ asset( "js/view.js" ) }}"></script>
@endpush

@section("content")
    <div class = "container-lg">
        <div class = "d-flex justify-content-between d-lg-block mt-3">
            <a
                href = "{{ route( "summaries_edit", [ "id" => $data->id ] ) }}"
                class = "btn btn-primary"
            >
                Изменить
            </a>
            <a
                href = "{{ route( "pdf", [ "id" => $data->id ] ) }}"
                class = "btn btn-primary"
            >
                Скачать PDF
            </a>
            <button
                class = "btn btn-danger"
                onclick = "destroy( '{{ route( "summaries_destroy", [ "summary" => $data->id ] ) }}' )"
            >
                Удалить
            </button>
        </div>
        <div class = "row text-black mt-3">
            <div class = "col-lg-4">
                <div class="card bg-light mb-3">
                    <div class="card-header">Полное имя</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->name }}</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4">
                <div class="card bg-light mb-3">
                    <div class="card-header">Дата собеседования</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->date }}</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-4">
                <div class="card bg-light mb-3">
                    <div class="card-header">E-Mail</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->email }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class = "row text-black">
            <div class = "col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Статус</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->status }}</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Уровень</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->level ?? "N/A" }}</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Позиция</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->position }}</p>
                    </div>
                </div>
            </div>
            <div class = "col-lg-3">
                <div class="card bg-light mb-3">
                    <div class="card-header">Кто завёл резюме</div>
                    <div class="card-body">
                        <p class="card-text">{{ $data->user_name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class = "row text-black">
            <div class = "col-12">
                <div class = "card bg-light">
                    <div class="card-header">Навыки</div>
                    <div class="card-body">
                        {!! $data->skills !!}
                    </div>
                </div>
            </div>
        </div>
        <div class = "row text-black mt-3">
            <div class = "col-12">
                <div class = "card bg-light">
                    <div class="card-header">Описание</div>
                    <div class="card-body">
                        {!! $data->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class = "row text-black mt-3">
            <div class = "col-12">
                <div class = "card bg-light">
                    <div class="card-header">Опыт</div>
                    <div class="card-body">
                        {!! $data->experience !!}
                    </div>
                </div>
            </div>
        </div>
        <div class = "d-flex justify-content-between d-lg-block mt-3">
            <a
                href = "{{ route( "summaries_edit", [ "id" => $data->id ] ) }}"
                class = "btn btn-primary"
            >
                Изменить
            </a>
            <a
                href = "{{ route( "pdf", [ "id" => $data->id ] ) }}"
                class = "btn btn-primary"
            >
                Скачать PDF
            </a>
            <button
                class = "btn btn-danger"
                onclick = "destroy( '{{ route( "summaries_destroy", [ "summary" => $data->id ] ) }}' )"
            >
                Удалить
            </button>
        </div>
    </div>
@endsection
