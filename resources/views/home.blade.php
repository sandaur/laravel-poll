@extends('layouts.app')

@section('content')
<main role="main" class="container">

    @include('includes.status')

    {{-- Votations Dashboard --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Votaciones Habiles</h3>

            <div class="media text-muted pt-3">
                {{-- Votation Instance Status --}}
                <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_164e224652c%20text%20%7B%20fill%3A%23e83e8c%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_164e224652c%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23e83e8c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 32px; height: 32px;">

                {{-- Votation Instance Info --}}
                <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                    <strong class="d-block text-gray-dark">Nombre Votacion</strong>
                    Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>

                {{-- Votation Instance Controls --}}
                <div class="dropdown align-self-center">
                    <button class="btn rounded-0 btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modificar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <button class="dropdown-item" type="button">Opciones</button>
                        <button class="dropdown-item" type="button">Datos</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" type="button">Eliminar</button>
                    </div>
                </div>
            </div>

            @foreach ($votations as $poll)
                <div class="media text-muted pt-3">
                    {{-- Votation Status --}}
                    <img data-src="holder.js/32x32?theme=thumb&amp;bg=e83e8c&amp;fg=e83e8c&amp;size=1" alt="32x32" class="mr-2 rounded" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2232%22%20height%3D%2232%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2032%2032%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_164e224652c%20text%20%7B%20fill%3A%23e83e8c%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A2pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_164e224652c%22%3E%3Crect%20width%3D%2232%22%20height%3D%2232%22%20fill%3D%22%23e83e8c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2211.546875%22%20y%3D%2216.9%22%3E32x32%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 32px; height: 32px;">
    
                    {{-- Votation Info --}}
                    <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray pr-2">
                        <strong class="d-block text-gray-dark">{{ $poll->title }}</strong>
                        {{ $poll->description }}
                    </p>
    
                    {{-- Votation Controls --}}
                    <div class="dropdown align-self-center">
                        <button class="btn btn-secondary dropdown-toggle rounded-0" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Modificar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('opt-form').submit();">
                                Opciones</button>
                            <button class="dropdown-item" type="button">Datos</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('del-poll-form').submit();">
                                Eliminar</button>

                            {{-- Dropmenu Form Request --}}
                            <form action="{{ route('del-votation') }}" id="del-poll-form" method="POST" class="hidden">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="hidden" name="poll-id" value="{{ $poll->id }}">
                            </form>
                            <form action="{{ route('create-option', ['pollid' => $poll->id]) }}" id="opt-form" method="get"></form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- New Votation Form --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Crear Nueva Votacion</h3>
            <form method="POST" action="{{ route('new-votation') }}">
                {{ csrf_field() }}

                {{-- Subdomain for the Votation --}}
                <div class="form-group row">
                    <label for="vote-subdom" class="col-md-3 col-form-label">Subdominio</label>
                    <div class="col-md-9">
                        
                        <div class="input-group">
                            <input type="text" name="vote-subdom" class="form-control rounded-0" placeholder="Subdominio" aria-label="Subdominio" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text rounded-0 font-weight-bold" id="basic-addon2">.laravel.test/votacion</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Votation Title --}}
                <div class="form-group row">
                    <label for="vote-title" class="col-md-3 col-form-label">Titulo</label>
                    <div class="col-md-9">
                        <input name="vote-title" type="text" class="form-control rounded-0" placeholder="Titulo" required>
                    </div>
                </div>
                
                {{-- Votation Description --}}
                <div class="form-group row">
                    <label for="vote-desc" class="col-md-3 col-form-label">Descripcion</label>
                    <div class="col-md-9">
                        <textarea name="vote-desc" class="form-control rounded-0" rows="4" placeholder="Descripcion de la votacion"></textarea>
                    </div>
                </div>

                {{-- Votation Valid Dates --}}
                <div class="form-group row">
                    <label for="" class="col-md-3 col-form-label">Duracion<span class="text-muted"><small> Opcional</small></span></label>
                    <div class="col-md-4">
                        <input name="vote-from" type="text" class="form-control rounded-0" placeholder="Desde">
                    </div>
                    <div class="col-md-4 offset-md-1">
                            <input name="vote-to" type="text" class="form-control rounded-0" placeholder="Hasta">
                        </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary rounded-0">Crear Votacion</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</main>
@endsection
