<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }
        .position-ref {
            position: relative;
        }
        .content {
            text-align: center;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .menu > a{
            text-decoration-line: none;
            padding:0 30px;

        }
        .login{
            border: 1px #636b6f solid;
        }
    </style>
</head>
<body>
<div class="position-ref full-height">
    <div class="login">Witaj Admin</div>
    <div class="menu">
        <a href="#">Dodaj Pytanie</a>
        <a href="#">Dodaj Użytkownika</a>
        <a href="#">Sprawdz Odpowiedzi</a>
    </div>
</div>
</body>
</html>
