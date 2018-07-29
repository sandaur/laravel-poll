@extends('layouts.app')

@section('content')
<main class="container">
    @include('includes.status')

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <h3 class="mb-4">Votaciones Habiles</h3>
            
            @foreach ($options as $opt)
                <h2>Hey listen!</h2>
            @endforeach
        </div>
    </div>

    <div class="row justify-content-center mt-4">
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

                <div class="form-group row">
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