<!DOCTYPE html>

<html lang = "ru">
<head>
    <title>BDA Team | {{ $title }}</title>
    <meta charset = "utf8" />
    <meta id = "csrf-token" content = "{{ csrf_token() }}" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel = "stylesheet" href = "{{ asset( "css/app.css" ) }}">
    @stack( "styles" )
</head>

<body>
<div class = "d-flex flex-column bg-dark text-white" style = "height: 100vh">
    <header>
        <div class = "p-3 border-bottom">
            <div class = "d-flex justify-content-between container-lg">
                <a href = "/" class = "text-warning text-decoration-none navbar-brand">
                    BDA Team
                </a>
                <div class = "d-none d-lg-flex w-100">
                    <a href="{{ route( "dashboard" ) }}" class="nav-link px-2 text-white">Главная</a>
                    <a href="{{ route( "createNewCV" ) }}" class="nav-link px-2 text-white">Добавить резюме</a>

                    @if( Auth::user()->role->name === "admin" )
                        <a href="{{ route( "admin" ) }}" class="nav-link px-2 text-white">Администрирование</a>
                    @endif
                </div>
                <div class = "d-flex align-items-center">
                    <div class = "dropdown">
                        <a
                            class = "btn btn-secondary dropdown-toggle"
                            href = "#"
                            role = "button"
                            id = "dropdownMenuLink"
                            data-bs-toggle = "dropdown"
                            aria-expanded = "false"
                        >
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{route("signOut")}}">Выйти</a></li>
                        </ul>
                    </div>
                    <button class = "d-lg-none btn border ms-3" onclick = "headerMenu( 'show' )">
                        <i class = "fas fa-bars text-white"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id = "headerMenu" class = "header-menu d-none d-lg-none p-3 bg-dark">
            <div class = "d-flex justify-content-between container">
                <a href = "/" class = "text-warning text-decoration-none navbar-brand">
                    BDA-Final
                </a>
                <button class = "btn border" onclick = "headerMenu( 'hide' )">
                    <i class = "fas fa-times text-white"></i>
                </button>
            </div>
            <a href="{{ route( "dashboard" ) }}" class="nav-link px-2 text-white">Главная</a>
            <a href="{{ route( "createNewCV" ) }}" class="nav-link px-2 text-white">Добавить резюме</a>

            @if( Auth::user()->role->name === "admin" )
                <a href="{{ route( "admin" ) }}" class="nav-link px-2 text-white">Администрирование</a>
            @endif
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src = "{{ asset( "js/app.js" ) }}"></script>
@stack( "scripts" )
</body>
</html>
