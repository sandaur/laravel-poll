@extends('layouts.app')

@section('content')
<main class="container">
    @include('includes.status')

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Opciones Habiles</h3>
            
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
                            <button class="dropdown-item" type="button">Datos</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" type="button" onclick="event.preventDefault();document.getElementById('del-option{{ $opt->id }}').submit();">
                                Eliminar</button>
                            
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
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3 class="mb-4">Nueva Opcion</h3>

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
                        <textarea name="opt-desc" class="form-control rounded-0{{ $isValid['opt-desc'] }}" rows="4" placeholder="Descripcion de la opcion" required>{{ old('opt-desc') }}</textarea>
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
                            <button type="submit" class="btn btn-primary rounded-0">Crear Opcion</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    </form>
</main>
@endsection