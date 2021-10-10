<!DOCTYPE html>

<html>
<head>
    <title>Final CMS | Вход</title>
    <meta charset = "utf8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel = "stylesheet" href = "{{ asset( "css/login.css" ) }}">
</head>

<body class="text-center bg-dark text-light">
    <main class="form-signin">
        <form method="post" action="{{route("signIn")}}">
            @csrf
            <h1 class="h3 mb-3 fw-normal">BDA final</h1>

            <div class="form-floating text-dark">
                <input name="login" type="text" class="form-control" id="floatingInput" placeholder="Login">
                <label for="floatingInput">Login</label>
            </div>
            <div class="form-floating text-dark mt-2">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
        </form>
    </main>
</body>
</html>
