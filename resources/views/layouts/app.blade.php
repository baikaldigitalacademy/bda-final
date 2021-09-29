<!DOCTYPE html>

<html lang = "ru">
<head>
    <title>Final CMS | {{ $title }}</title>
    <meta charset = "utf8" />
    <meta id = "csrf-token" content = "{{ csrf_token() }}" />

    @if( !isset( $miniCssNotLoad ) || !$miniCssNotLoad )
        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css" />
    @endif

    @if( isset( $icons ) && $icons )
        <link rel = "stylesheet" type = "text/css" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @endif

    <link rel = "stylesheet" type = "text/css" href = "{{ asset( "css/app.css" ) }}">

    @stack( "styles" )
</head>

<body>
<div class = "container">
    <div class = "container__block0">
        @include('layouts.header')
        @if( $errors->any() )
            @foreach( $errors->all() as $error )
                <div>{{ $error }}</div>
            @endforeach
        @endif
        <div>
            @yield( "content" )
        </div>
    </div>

    @stack( "scripts" )
</div>
</body>
</html>
