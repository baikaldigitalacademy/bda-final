<!DOCTYPE html>

<html lang = "ru">
<head>
    <title>Final CMS | {{ $title }}</title>
    <meta charset = "utf8" />
    <meta id = "csrf-token" content = "{{ csrf_token() }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    @if( isset( $icons ) && $icons )
        <link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @endif

    <link rel = "stylesheet" href = "{{ asset( "css/app.css" ) }}">

    @stack( "styles" )
</head>

<body>
<div class = "d-flex flex-column bg-dark text-white" style = "height: 100vh">
    <header class="p-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-warning text-decoration-none navbar-brand">
                    BDA-Final
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route( "dashboard" ) }}" class="nav-link px-2 text-white">Главная</a></li>
                    <li><a href="{{ route( "createNewCV" ) }}" class="nav-link px-2 text-white">Добавить резюме</a></li>

                    @if( Auth::user()->role->name === "admin" )
                        <li><a href="{{ route( "admin" ) }}" class="nav-link px-2 text-white">Администрирование</a></li>
                    @endif
                </ul>

                <div class="text-end">
                    <a href = "{{ route( "signOut" ) }}" class = "btn btn-outline-light me-2">Выйти</a>
                </div>
            </div>
        </div>
    </header>

    @if( $errors->any() )
        <div class = "alert alert-danger">
            @foreach( $errors->all() as $error )
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class = "d-flex" style = "height: 100%; overflow: auto">
        @yield( "content" )
    </div>
</div>

@stack( "scripts" )
</body>
</html>
