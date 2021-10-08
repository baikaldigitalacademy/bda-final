<!DOCTYPE html>

<html>
<head>
    <title>Final CMS | Вход</title>
    <meta charset = "utf8">

    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css" />

    <link rel = "stylesheet" href = "{{ asset( "css/login.css" ) }}">
</head>

<body>
    <div class = "login-container">
        @if( $errors->any() )
            @foreach( $errors->all() as $error )
                <div>{{ $error }}</div>
            @endforeach
        @endif

        <form action = "{{ route( "signIn" ) }}" method = "post" class = "login-container__form">
            @csrf
            <input type = "text" name = "login" placeholder = "Логин" value = "{{ old( "login" ) }}"> <br>
            <input type = "password" name = "password" placeholder = "Пароль"> <br>
            <input type = "submit" value = "Войти" class = "login-container__sign-in">
        </form>
    </div>
</body>
</html>
