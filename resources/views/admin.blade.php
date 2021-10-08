@extends( "layouts.app", [ "title" => "Админка" ] )

@section( "content" )
    <h3>Справочники</h3>
    <ul>
        <li>
            <a href = "{{ route( "positions_all" ) }}">Возможные позиции кандидатов</a>
        </li>
        <li>
            <a href = "{{ route( "levels_all" ) }}">Возможные уровни кандидатов</a>
        </li>
        <li>
            <a href = "{{ route( "summary_statuses_all" ) }}">Возможные статусы (решения) для резюме</a>
        </li>
    </ul>
@endsection
