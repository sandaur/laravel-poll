<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vatacion') }}</title>

    <!-- Styles -->
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        html,body{
            height: 100%;
        }
    </style>
</head>
<body class="py-5">
    <form class="mx-auto" style="width: 100%; max-width: 420px; padding: 15px" method="POST" action="{{ route('login') }}">
            <div class="text-center mb-4">
                <img class="mb-4 rounded" src="{{ asset('images/logo.jpg') }}" alt="Logo" width="92" height="92">
                <h1 class="h3 mb-3 font-weight-normal">{{ config('app.name', 'Votacion') }}</h1>
            </div>

            {{-- Error message display --}}
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    <strong>Autenticacion Fallida!</strong> {{ session()->get('message') }}
                </div>
            @endif

            {{ csrf_field() }}
            
            {{-- Email form input --}}
            <div class="form-group">
                <label for="inputEmail">Correo Electronico</label>
                <input type="email" id="inputEmail" value="{{ old('email') }}" class="form-control" placeholder="Correo Electronico" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        
            {{-- Password form input --}}
            <div class="form-group">
                <label for="inputPassword">Contraseña</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        
            {{-- Remember form input --}}
            <div class="checkbox mb-3">
                <label>
                <input type="checkbox" name="remember" value="remember-me"> Recordar mis datos
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted text-center">© Universidad Catolica de Temuco - 2018</p>
        </form>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>