@extends( "layouts.admin", [ "title" => $isNew ? "Создание нового пользователя" : $user->name ] )

@if( !$isNew )
    @push( "scripts" )
        <script src = "{{ asset( "js/users/edit.js" ) }}"></script>
    @endpush
@endif

@section( "content-admin" )
    <div class = "p-4">
        <form method="post" action="{{$isNew ? route('users_store') : route('users_update', ['user'=>$user])}}">
            @csrf
            @if(!$isNew)
                @method("put")
            @endif

            <div class = "d-flex justify-content-between d-lg-block mb-2">
                <button type = "submit" class = "btn btn-success">Сохранить</button>
                @if( !$isNew )
                    <button id = "deleteFormSubmit" type = "button" class = "btn btn-danger">
                        Удалить
                    </button>
                @endif
                <a href = "{{ route( "users_all" ) }}" class = "btn btn-primary">Назад</a>
            </div>
            <label for = "name">Имя</label>
            <input
                type = "text"
                class = "form-control"
                id = "name"
                name = "name"
                value = "{{old('name') ?? $user->name}}"
            >
            <label for = "login">Логин</label>
            <input
                type = "text"
                class = "form-control"
                id = "login"
                name = "login"
                value = "{{old('login') ?? $user->login}}"
            >
            @if( $isNew )
                <label for = "password">Пароль</label>
                <input
                    type = "password"
                    class = "form-control"
                    id = "password"
                    name = "password"
                    value = ""
                >
            @endif
            <label for = "role_id">Роль</label>
            <select id = "role_id" name = "role_id" class = "form-select">
                <option disabled selected value>Выберите роль</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}"
                        @if($role->id == old("role_id") or $role->id == $user->role_id)
                        selected
                        @endif
                    >
                        {{$role->name}}
                    </option>
                @endforeach
            </select>
        </form>

        @if( !$isNew )
            <form
                id = "deleteForm"
                action = "{{ route( "users_destroy", [ "user" => $user->id ] ) }}"
                method = "post"
                class = "d-none"
            >
                @csrf
                @method( "delete" )
            </form>
        @endif
    </div>
@endsection
