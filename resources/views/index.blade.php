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

            $colorClass = "text-primary";
        }

        echo <<<TEXT
          <th>
            <div
              data-header = "$order $newOrderDirection"
              class = "clickable"
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

@push( "scripts" )
    <script>
        const BASE_URL = "{{ url( "/summaries" ) }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script src = "{{ asset( "js/index.js" ) }}"></script>
@endpush

@section( "content" )
    <div class="d-flex flex-column flex-shrink-0 p-3 border-end" style="width: 280px">
        <span class="fs-4">Фильтры</span>
        <hr>
        <form id = "filtersForm">
            <label for = "name">Имя</label>
            <div class = "d-flex">
                <input
                    id = "name"
                    name = "name"
                    class = "form-control"
                    value = "{{ $name ?? "" }}"
                    placeholder = "Иванов Иван"
                >
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'name' )"></i>
                </div>
            </div>
            <label for = "email">E-Mail</label>
            <div class = "d-flex">
                <input
                    id = "email"
                    name = "email"
                    class = "form-control"
                    value = "{{ $email ?? "" }}"
                    placeholder = "example@example.com"
                >
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'email' )"></i>
                </div>
            </div>
            <label for = "position_id">Позиция</label>
            <div class = "d-flex">
                <select
                    id = "position_id"
                    name = "position_id"
                    class = "form-select"
                >
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
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'position_id', 'any' )"></i>
                </div>
            </div>
            <label for = "level_id">Уровень</label>
            <div class = "d-flex">
                <select
                    id = "level_id"
                    name = "level_id"
                    class = "form-select"
                >
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
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'level_id', 'any' )"></i>
                </div>
            </div>
            <label for = "date_start">Дата от</label>
            <div class = "d-flex">
                <input
                    type = "date"
                    id = "date_start"
                    name = "date_start"
                    class = "form-control"
                    value = {{ $dateStart ?? "" }}
                >
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'date_start' )"></i>
                </div>
            </div>
            <label for = "date_end">Дата до</label>
            <div class = "d-flex">
                <input
                    type = "date"
                    id = "date_end"
                    name = "date_end"
                    class = "form-control"
                    value = {{ $dateEnd ?? "" }}
                >
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'date_end' )"></i>
                </div>
            </div>
            <label for = "status_id">Решение:</label>
            <div class = "d-flex">
                <select
                    id = "status_id"
                    name = "status_id"
                    class = "form-select"
                >
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
                <div class = "ms-2 d-flex justify-content-center align-items-center">
                    <i class = "fas fa-trash clickable" onclick = "clearOneFilter( 'status_id', 'any' )"></i>
                </div>
            </div>
            <div class = "d-flex mt-2">
                <button class = "btn btn-success me-2">
                    <i class = "fas fa-check"></i>
                </button>
                <button
                    type = "button"
                    class = "btn btn-danger"
                    style = "width: 100%"
                    onclick = "refreshClear()"
                >
                    Сбросить всё
                </button>
            </div>
        </form>
    </div>
    <div class = "bg-white" style = "width: 100%; overflow: auto">
        <table class = "table">
            <thead>
            <tr>
                {{ $headerColumn( "ID", "id" ) }}
                {{ $headerColumn( "Имя", "name" ) }}
                {{ $headerColumn( "E-Mail", "email" ) }}
                {{ $headerColumn( "Позиция", "position_id" ) }}
                {{ $headerColumn( "Уровень", "level_id" ) }}
                {{ $headerColumn( "Дата", "date" ) }}
                {{ $headerColumn( "Решение", "status_id" ) }}
            </tr>
            </thead>
            <tbody>
            @foreach( $summaries as $summary )
                @php( $style = $summary->status->color ? "background-color: {$summary->status->color}" : "" )

                <tr id = "summary{{ $summary->id }}">
                    <td style = "{{ $style }}">{{ $summary->id }}</td>
                    <td style = "{{ $style }}">
                        <a href = "{{ route( "summaries_one", [ "id" => $summary->id ] ) }}">{{ $summary->name }}</a>
                    </td>
                    <td style = "{{ $style }}">{{ $summary->email }}</td>
                    <td style = "{{ $style }}">{{ $summary->position->name }}</td>
                    <td style = "{{ $style }}">{{ $summary->level->name ?? "N/A" }}</td>
                    <td style = "{{ $style }}">{{ $summary->date }}</td>
                    <td style = "{{ $style }}">
                        <select
                            id = "summaryStatus{{ $summary->id }}"
                            class = "form-select"
                            onchange = "changeStatus( {{ $summary->id }} )"
                        >
                            @foreach( $statuses as $status )
                                <option
                                    value = "{{ $status->id }}"
                                    @if( $summary->status->id === $status->id ) selected @endif
                                >
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
