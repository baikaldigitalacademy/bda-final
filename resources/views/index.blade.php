<?php
    $name = $query[ "name" ] ?? "";
    $email = $query[ "email" ] ?? "";
    $positionId = $query[ "position_id" ] ?? null;
    $levelId = $query[ "level_id" ] ?? null;
    $withoutLevel = $query[ "without_level" ] ?? null;
    $dateStart = $query[ "date_start" ] ?? "";
    $dateEnd = $query[ "date_end" ] ?? "";
    $statusId = $query[ "status_id" ] ?? null;
    $orderColumn = $query[ "order_column" ] ?? "id";
    $orderDirection = $query[ "order_direction" ] ?? "asc";

    $headerColumn = function( $name, $order ) use( $orderColumn, $orderDirection ){
        $iconDirection = "up";
        $newOrderDirection = "asc";
        $colorClass = "";

        if( $order === $orderColumn ){
            if( $orderDirection === "asc" ){
                $newOrderDirection = "desc";
                $iconDirection = "up";
            } else {
                $newOrderDirection = "asc";
                $iconDirection = "down";
            }

            $colorClass = "summaries__header-icon_selected";
        }

        echo <<<TEXT
          <th>
            <div
              data-header = "$order $newOrderDirection"
              class = "clickable summaries__header"
            >
              $name
              <i class = "fas fa-sort-amount-$iconDirection $colorClass"></i>
            </div>
          </th>
        TEXT;
    };
?>

@extends( "layouts.app", [
  "icons" => true,
  "title" => "Главная"
] )

@push( "styles" )
    <link rel = "stylesheet" type = "text/css" href = "{{ asset( "css/index.css" ) }}">
@endpush

@push( "scripts" )
    <script src = "{{ asset( "js/index.js" ) }}"></script>
@endpush

@section( "content" )
    @if( $summaries->isEmpty() )
        <h3>Not found</h3>
    @else
        <h3>Фильтры</h3>
        <form id = "filtersForm">
            <div>
                Имя:
                <input
                    name = "name"
                    value = "{{ $name ?? "" }}"
                    placeholder = "Иванов Иван"
                >
            </div>
            <div>
                E-Mail:
                <input
                    name = "email"
                    value = "{{ $email ?? "" }}"
                    placeholder = "example@example.com"
                >
            </div>
            <div>
                Позиция:
                <select name = "position_id">
                    <option
                        value = "any"
                        {{ $positionId ? "" : "selected" }}
                    >
                        Любая
                    </option>
                    @foreach( $positions as $position )
                        <option
                            value = "{{ $position->id }}"
                            {{ $positionId == $position->id ? "selected" : "" }}
                        >
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                Уровень:
                <select name = "level_id">
                    <option
                        value = "any"
                        {{ $levelId || $withoutLevel ? "" : "selected" }}
                    >
                        Любой
                    </option>
                    @foreach( $levels as $level )
                        <option
                            value = "{{ $level->id }}"
                            {{ $levelId == $level->id ? "selected" : "" }}
                        >
                            {{ $level->name }}
                        </option>
                    @endforeach
                    <option
                        value = "null"
                        {{ $withoutLevel ? "selected" : "" }}
                    >
                        Без уровня
                    </option>
                </select>
            </div>
            <div>
                Дата: от
                <input
                    type = "date"
                    name = "date_start"
                    value = {{ $dateStart ?? "" }}
                >
                до
                <input
                    type = "date"
                    name = "date_end"
                    value = {{ $dateEnd ?? "" }}
                >
            </div>
            <div>
                Решение:
                <select name = "status_id">
                    <option
                        value = "any"
                        {{ $statusId ? "" : "selected" }}
                    >
                        Любое
                    </option>
                    @foreach( $statuses as $status )
                        <option
                            value = "{{ $status->id }}"
                            {{ $statusId == $status->id ? "selected" : "" }}
                        >
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type = "submit" value = "Применить">
        </form>
        <h3>
            Резюме ({{ $summaries->count() }})
            <a href = "{{ route( "createNewCV" ) }}">Добавить резюме</a>
        </h3>
        <table>
            <tr>
                {{ $headerColumn( "ID", "id" ) }}
                {{ $headerColumn( "Имя", "name" ) }}
                {{ $headerColumn( "E-Mail", "email" ) }}
                {{ $headerColumn( "Позиция", "positions" ) }}
                {{ $headerColumn( "Уровень", "levels" ) }}
                {{ $headerColumn( "Дата", "date" ) }}
                {{ $headerColumn( "Решение", "summary_statuses" ) }}
            </tr>
            @foreach( $summaries as $summary )
                @php( $style = $summary->status_color ? "background-color: $summary->status_color" : "" )

                <tr
                    class = "clickable"
                    onclick = "window.open( '{{ route( "summaries_one", [ "id" => $summary->id ] ) }}', '_self' )"
                >
                    <td style = "{{ $style }}">{{ $summary->id }}</td>
                    <td style = "{{ $style }}">{{ $summary->name }}</td>
                    <td style = "{{ $style }}">{{ $summary->email }}</td>
                    <td style = "{{ $style }}">{{ $summary->position_name }}</td>
                    <td style = "{{ $style }}">{{ $summary->level_name ?? "N/A" }}</td>
                    <td style = "{{ $style }}">{{ $summary->date }}</td>
                    <td style = "{{ $style }}">{{ $summary->status_name }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@endsection
