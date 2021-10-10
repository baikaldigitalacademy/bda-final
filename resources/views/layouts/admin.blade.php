@extends( "layouts.app", [
  "title" => $title ?? "Администрирование"
] )

@section( "content" )
    <div class="d-flex flex-column flex-shrink-0 p-3" style="width: 280px">
        <span class="fs-4">Справочники</span>
        <hr>
        <ul class = "nav nav-pills flex-column mb-auto">
            <li>
                <a
                    href = "{{ route( "positions_all" ) }}"
                    class = "nav-link text-white"
                >
                    Возможные позиции кандидатов
                </a>
            </li>
            <li>
                <a
                    href = "{{ route( "levels_all" ) }}"
                    class = "nav-link text-white"
                >
                    Возможные уровни кандидатов
                </a>
            </li>
            <li>
                <a
                    href = "{{ route( "summary_statuses_all" ) }}"
                    class = "nav-link text-white"
                >
                    Возможные статусы (решения) для резюме
                </a>
            </li>
        </ul>
    </div>

    <div class = "p-4" style = "width: 100%; overflow: auto">
        @yield( "content-admin" )
    </div>
@endsection
