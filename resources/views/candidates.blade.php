@extends('layouts.app')

@section('content')
<main class="container">

    <div class="row justify-content-center mt-4">
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Votaciones</a></li>
                    <li class="breadcrumb-item"><a href="#notImplemented">{{ $pollName }}</a></li>
                    <li class="breadcrumb-item" aria-current="page">Candidatos</li>
                </ol>
            </nav>
        </div>
    </div>

    @include('includes.status')

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Candidatos Habiles</h3>
            
            @foreach ($options as $opt)
                <div class="media mt-3">
                    <img class="mr-3 bg-secondary rounded" src="{{ asset('storage/opt_img/'.$opt->image) }}" alt="option image" width="64px" height="64px">
                    <div class="media-body pb-3 border-bottom pr-2">
                    <h5 class="mt-0">Media heading</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                    
                    <div class="dropdown align-self-center">
                        <button class="btn btn-secondary dropdown-toggle rounded-0" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Modificar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <a href="#" class="dropdown-item">Datos</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault();document.getElementById('del-option{{ $opt->id }}').submit();">
                                Eliminar</a>
                            
                            {{-- Dropmenu Form Request --}}
                            <form action="{{ route('delete-option', ['pollid' => $pollid]) }}" id="del-option{{ $opt->id }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="hidden" name="opt-id" value="{{ $opt->id }}">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($options->count() < 2)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Importante!</h4>
                    <p>Para activar esta votacion y abrir el subdominio de la urna al publico es necesario tener dos o mas <strong>candidatos</strong> definidos en esta seccion.</p>
                    <hr>
                    <p class="mb-0">Para crear un nuevo candidato dirigete al formulario de mas abajo.</p>
                </div>
            @endif

        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="mb-4">Nuevo Cadidato</h3>

            {{-- Create valid or invalid class for every input --}}
            @php
                $inputNames = ['opt-name','opt-desc'];
                $isValid = array();
                foreach ($inputNames as $name) {
                    $isValid[$name] = old($name)? ($errors->has($name)? ' is-invalid':' is-valid'):'';
                }
                $isValid['opt-img'] = ($errors->has('opt-img')? ' is-invalid':'')
            @endphp

            <form action="{{ route('store-option', ['pollid' => $pollid]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                {{-- Name for the Option --}}
                <div class="form-group row">
                    <label for="opt-name" class="col-md-3 col-form-label">Titulo</label>
                    <div class="col-md-9">
                        <input name="opt-name" value="{{ old('opt-name') }}" type="text" class="form-control rounded-0{{ $isValid['opt-name'] }}" placeholder="Titulo" required>
                        <div class="valid-feedback" >Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('opt-name') }}</div>
                    </div>
                </div>

                {{-- Description for the Option --}}
                <div class="form-group row">
                    <label for="opt-desc" class="col-md-3 col-form-label">Descripcion</label>
                    <div class="col-md-9">
                        <textarea name="opt-desc" class="form-control rounded-0{{ $isValid['opt-desc'] }}" rows="4" placeholder="Descripcion del candidato" required>{{ old('opt-desc') }}</textarea>
                        <div class="valid-feedback" >Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('opt-desc') }}</div>
                    </div>
                </div>

                {{-- Image for the Option --}}
                <div class="form-group row">
                    <label for="opt-img" class="col-md-3 col-form-label">Imagen</label>
                    <div class="col-md-9 custom-file">
                        <input name="opt-img" type="file" accept="image/*" class="custom-file-input{{ $isValid['opt-img'] }}" id="customFile" required>
                        <label class="custom-file-label rounded-0 mx-3" for="customFile">Imagen</label>
                        <div class="valid-feedback" >Looks good!</div>
                        <div class="invalid-feedback">{{ $errors->first('opt-img') }}</div>
                    </div>
                </div>

                <div class="form-group row mt-4">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary rounded-0">Crear Candidato</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    </form>
</main>
@endsection