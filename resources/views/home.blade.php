@extends('layouts.app')

@section('content')
<main role="main" class="container">

    @include('includes.status')

    {{-- Votations Dashboard --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Votaciones Habiles</h3>

            @foreach ($votations as $poll)
                <div class="media text-muted pt-3">
                    {{-- Votation Status --}}
                    @php
                        $statusColor = "https://dummyimage.com/32x32/34495e/34495e.jpg";
                        if ($poll->status == "closed"){
                            $statusColor = "https://dummyimage.com/32x32/e74d3c/e74d3c.jpg";
                        } else if ($poll->status == "open"){
                            $statusColor = "https://dummyimage.com/32x32/2ecc71/2ecc71.jpg";
                        } else if ($poll->status == "waiting"){
                            $statusColor = "https://dummyimage.com/32x32/e67e22/e67e22.jpg";
                        }
                    @endphp
                    <img src="{{ $statusColor }}" alt="status" class="mr-2 rounded" data-trigger="hover" data-toggle="tooltip" data-placement="left" title="{{ ucfirst($poll->status) }}" style="width: 32px; height: 32px;">
    
                    {{-- Votation Info --}}
                    <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray pr-2">
                        <strong class="d-block text-gray-dark">
                            {{ $poll->title }}
                            <small>({{ $poll->start_time }} - {{ $poll->end_time }})</small>
                            <a href="http://{{ $poll->subdom }}.laravel.test/urna"><i>{{ $poll->subdom }}<small>.laravel.test/urna</small></i></a>
                        </strong>
                        {{ $poll->description }}
                    </p>
    
                    {{-- Votation Controls --}}
                    <div class="dropdown align-self-center">
                        <button class="btn btn-secondary dropdown-toggle rounded-0" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Modificar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('opt-form-{{ $poll->id }}').submit();">
                                Opciones</button>
                            <button class="dropdown-item" type="button">Datos</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('del-poll-{{ $poll->id }}').submit();">
                                Eliminar</button>

                            {{-- Dropmenu Form Request --}}
                            <form action="{{ route('del-votation') }}" id="del-poll-{{ $poll->id }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="hidden" name="poll-id" value="{{ $poll->id }}">
                            </form>
                            <form action="{{ route('create-option', ['pollid' => $poll->id]) }}" id="opt-form-{{ $poll->id }}" method="get"></form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- New Votation Form --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">

            <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
            </div>

            <h3 class="mb-4">Crear Nueva Votacion</h3>
            <form method="POST" action="{{ route('new-votation') }}">
                {{ csrf_field() }}

                {{-- Create valid or invalid class for every input --}}
                @php
                $inputNames = ['vote-subdom','vote-title','vote-desc','vote-from','vote-to'];
                $isValid = array();
                foreach ($inputNames as $name) {
                    $isValid[$name] = old($name)? ($errors->has($name)? ' is-invalid':' is-valid'):'';
                }
                @endphp

                {{-- Subdomain for the Votation --}}
                <div class="form-group row">
                    <label for="vote-subdom" class="col-md-3 col-form-label">Subdominio</label>
                    <div class="col-md-9">
                        
                        <div class="input-group">
                            <input type="text" name="vote-subdom" value="{{ old('vote-subdom') }}" class="form-control rounded-0{{ $isValid['vote-subdom'] }}" placeholder="Subdominio" aria-label="Subdominio" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text rounded-0 font-weight-bold" id="basic-addon2">.laravel.test/votacion</span>
                            </div>
                            <div class="valid-feedback" >Looks good!</div>
                            <div class="invalid-feedback">{{ $errors->first('vote-subdom') }}</div>
                        </div>

                    </div>
                </div>

                {{-- Votation Title --}}
                <div class="form-group row">
                    <label for="vote-title" class="col-md-3 col-form-label">Titulo</label>
                    <div class="col-md-9">
                        <input type="text" name="vote-title" value="{{ old('vote-title') }}" class="form-control rounded-0{{ $isValid['vote-title'] }}" placeholder="Titulo" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('vote-title') }}</div>
                    </div>
                </div>
                
                {{-- Votation Description --}}
                <div class="form-group row">
                    <label for="vote-desc" class="col-md-3 col-form-label">Descripcion</label>
                    <div class="col-md-9">
                        <textarea name="vote-desc" class="form-control rounded-0{{ $isValid['vote-desc'] }}" rows="4" placeholder="Descripcion de la votacion">{{ old('vote-desc') }}</textarea>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('vote-desc') }}</div>
                    </div>
                </div>

                {{-- Votation Valid Dates --}}
                <div class="form-group row">
                    <label for="vote-from" class="col-md-3 col-form-label">Duracion<span class="text-muted"><small> Opcional</small></span></label>
                    <div class="col-md-4">
                        <input type="text" name="vote-from" value="{{ old('vote-from') }}" class="form-control rounded-0{{ $isValid['vote-from'] }}" placeholder="Desde">
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('vote-from') }}</div>
                    </div>
                    <div class="col-md-4 offset-md-1">
                        <input type="text" name="vote-to" value="{{ old('vote-to') }}" class="form-control rounded-0{{ $isValid['vote-to'] }}" placeholder="Hasta">
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('vote-to') }}</div>
                    </div>
                </div>

                <div class="form-group row mt-4">
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary rounded-0">Crear Votacion</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</main>
@endsection

@section('end-script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
