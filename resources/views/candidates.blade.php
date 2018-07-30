@extends('layouts.app')

@section('content')
<main class="container">
    @include('includes.status')

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Opciones Habiles</h3>
            
            @foreach ($options as $opt)
                <div class="media mt-3">
                    <img class="mr-3" src="http://placehold.jp/64x64.png" alt="option image">
                    <div class="media-body pb-3 border-bottom pr-2">
                    <h5 class="mt-0">Media heading</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                    
                    <div class="dropdown align-self-center">
                        <button class="btn btn-secondary dropdown-toggle rounded-0" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Modificar
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                            <button class="dropdown-item" type="button">Datos</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('del-option').submit();">
                                Eliminar</button>
                            
                            {{-- Dropmenu Form Request --}}
                            <form action="{{ route('delete-option', ['pollid' => $pollid]) }}" id="del-option" method="POST" class="hidden">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="hidden" name="opt-id" value="{{ $opt->id }}">
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="mb-4">Nueva Opcion</h3>

            <form action="{{ route('store-option', ['pollid' => $pollid]) }}" method="POST">
                {{ csrf_field() }}

                {{-- Name for the Option --}}
                <div class="form-group row">
                    <label for="opt-name" class="col-md-3 col-form-label">Titulo</label>
                    <div class="col-md-9">
                        <input name="opt-name" type="text" class="form-control rounded-0" placeholder="Titulo" required>
                    </div>
                </div>

                {{-- Description for the Option --}}
                <div class="form-group row">
                    <label for="opt-desc" class="col-md-3 col-form-label">Descripcion</label>
                    <div class="col-md-9">
                        <textarea name="opt-desc" class="form-control rounded-0" rows="4" placeholder="Descripcion de la opcion" required></textarea>
                    </div>
                </div>

                {{-- Image for the Option --}}
                <div class="form-group row">
                    <label for="opt-img" class="col-md-3 col-form-label">Imagen</label>
                    <div class="col-md-9 custom-file">
                        <input name="opt-img" type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label rounded-0" for="customFile">Imagen</label>
                    </div>
                </div>

                <div class="form-group row mt-4">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary rounded-0">Crear Opcion</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    </form>
</main>
@endsection