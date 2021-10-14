
@extends( "layouts.admin", [ "title" => $directoryName ] )

@section( "content-admin" )
    <div class = "container-lg mt-3">
        <form id = "editForm" method="post" action="{{$isNew ? route('user_store') : route('user_update', ['user'=>$user])}}">
            @csrf
            @if(!$isNew)
                @method("put")
            @endif

            <div class = "d-flex justify-content-between d-lg-block mb-2">
                <button type = "submit" class = "btn btn-success">Сохранить</button>
                <a href = "." class = "btn btn-primary">Назад</a>
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
            <label for = "password">Новый пароль</label>
            <input
                type = "password"
                class = "form-control"
                id = "password"
                name = "password"
                value = ""
            >
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
    </div>
@endsection
