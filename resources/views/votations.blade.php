@extends('test.master')

@section('title', 'Votaciones')
@section('vue-control', 'pollsManagement')

@section('main.content')
    <div class="page-title">
        <div class="title_left">
        <h3>Projects <small>Listing design</small></h3>
        </div>

        <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
            </div>
        </div>
        </div>
    </div>

    <votations-table ref="pollsTable"></votations-table>

    {{-- Modal Editar Candidatos --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-md">Mostrar Candidatos</button>

    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Candidatos</h4>
            </div>
            <div class="modal-body">
                
                    <ul class="list-unstyled msg_list">
                    @for($i = 0; $i < 4; $i++)
                    <li>
                        <a>
                        <span class="image" style="height: 100%">
                            <img style="padding: .2rem 0" src="http://placehold.jp/150x150.png" alt="img" />
                        </span>
                        <span>
                            <span>John Smith</span>
                            <span class="time">
                                <button class="btn btn-info btn-xs" data-toggle="modal" data-target=".algo-raro"><i class="fa fa-pencil"></i> Editar </button>
                                <button href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Eliminar </button>
                            </span>
                        </span>
                        <span class="message" style="padding-top: .5rem">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas amet debitis molestias iusto quasi consectetur officiis eveniet corrupti deleniti quibusdam.
                        </span>
                        </a>
                    </li>
                    @endfor
                    <li style="display: none;"></li>
                    </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>

            </div>
        </div>
    </div>
    {{-- End Modal Editar Candidatos --}}

    {{-- Modal Editar Candidato --}}
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".algo-raro">Editar Candidato</button>

    <div class="modal fade algo-raro" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Candidatos</h4>
            </div>
            <div class="modal-body">
                
                    <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype=multipart/form-data>

                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre/Titulo <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="message" required="required" class="form-control" name="message" rows="4" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                        data-parsley-validation-threshold="10"></textarea>
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagen <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="candidate_avatar" accept="image/*">
                </div>
                </div>
                
            </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>

            </div>
        </div>
    </div>
    {{-- End Modal Editar Candidato --}}

    
    {{-- Form Wizard --}}
    <poll-form-wizard v-on:poll-created="notifyComp"></poll-form-wizard>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/votations.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/votations.js') }}"></script>
    <script src="{{ asset('js/votationsVue.js') }}"></script>

    <script type="text/javascript">
        
    </script>
@endpush