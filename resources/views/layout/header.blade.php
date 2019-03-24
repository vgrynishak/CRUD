<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Testove</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        html,
        body {
            /*background-color: red;*/
            height: 100%;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .content {
            flex: 1 0 auto;
            display: flex;
        }
        .footer {
            flex: 0 0 auto;
        }

        .side {
            background: #dddddd;
            width: 18%;
            text-align: left;
            padding-left: 2rem;
            padding-top: 2rem;
        }

        .bg-light {
            background-color: #4789cc!important;
        }

        header a {
            color: blanchedalmond;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ffc107;
        }


    </style>
</head>
<body>
<div id="app" class="wrapper">
    @section('header')
        <header>
            {{request()->session()->get('name')}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @if(request()->session()->has('id'))
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Hello {{request()->session()->get('user')}} ! <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/add">Добавити Документ<span class="sr-only">(current)</span></a>
                            </li>
                        @else
                            <li class="nav-item active">
                                <a class="nav-link" href="/">Welcome guest<span class="sr-only">(current)</span></a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="/lists">Список Документів<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    @if(request()->session()->has('id'))
                        <form class="form-inline my-2 my-lg-0">
                            <a class="nav-link" href="/logout">Вийти</a>
                        </form>
                    @else
                        <form class="form-inline my-2 my-lg-0">
                            <a class="nav-link" href="/admin">Admin</a>
                        </form>
                    @endif
                </div>
            </nav>
        </header>
    @show
    <div class="content">
        @yield('mainbar')
    </div>

    @section('footer')
        <footer class="footer">
            <div class="pos-f-t">
                <nav class="navbar navbar-dark bg-dark">
                    vgrynish 2019
                </nav>
            </div>
        </footer>
    @show
</div>
</body>
<script src="{{asset('js/app.js')}}"></script>
</html>