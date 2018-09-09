<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    
    <div class="container">
        <div class="row mt-5 w-75">
            @foreach ($candidates as $candidate)
                <div class="media mt-3 shadow">
                    <img class="mr-3" src="{{ asset('storage/opt_img/'.$candidate->image) }}" alt="Generic placeholder image" style="width: 130px; heigh: 130px;">
                    <div class="media-body">
                    <h5 class="mt-0">{{ $candidate->name }}</h5>
                        {{ $candidate->description }}
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary btn-lg btn-block">Votar</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" method="POST" action="http://contro.uctvotation.xyz/cu/req">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">Acceso al sistema</div>
                        <div class="panel-body text-center">
                            <div class="form-group">
                                <img src="https://claveunica.gob.cl/images/logo.4583c3bc.png" width="300px">
                            </div>
                            <p class="lead">Por favor, ingrese con su cuenta de ClaveUnica</p>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-sign-in"></i> Ingresar al sistema
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>