@extends( "layouts.admin", [ "title" => "Пользователи" ] )

@section( "content-admin" )
    <div class = "bg-white">
        <table class = "table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Логин</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>
                        <a href = "{{ route( "users_edit", [ "user" => $user ] ) }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
