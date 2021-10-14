<?php

$name = $query[ "name" ] ?? "";
$role = $query[ "role" ] ?? "";

$orderColumn = $query[ "order_column" ] ?? "id";
$orderDirection = $query[ "order_direction" ] ?? "asc";
$orderIconDirection = $orderDirection === "asc" ? "up" : "down";

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

@extends( "layouts.admin", [ "title" => $directoryName ] )

@push( "scripts" )
    <script src = "{{ asset( "js/directories/successCallbacks.js" ) }}"></script>
    <script src = "{{ asset( "js/directories/simple.js" ) }}"></script>
@endpush

@section( "content-admin" )

    <div id = "errorsDiv" class = "alert alert-danger d-none"></div>
    <div class="bg-white">
        <table class = "table">
            <thead>
            <tr>
                {{ $headerColumn( "ID", "id" ) }}
                {{ $headerColumn( "Имя", "name" ) }}
                {{ $headerColumn( "Уровень", "role" ) }}
            </tr>
            </thead>
            <tbody>
            @foreach( $users as $user )
                <tr id = "summary{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href = "{{ route( "users_one", [ "user" => $user ] ) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
