@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" method="POST" action="{{ route('oauth') }}">
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
@endsection
