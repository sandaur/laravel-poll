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

    {{-- Tabla de votaciones --}}
    <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Projects</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <p>Simple table with project listing with progress and editing options</p>

                    <!-- start project list -->
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 1%">#</th>
                          <th style="width: 20%">Project Name</th>
                          <th>Team Members</th>
                          <th>Project Progress</th>
                          <th>Status</th>
                          <th style="width: 20%">#Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                        @for($i = 0; $i < 5; $i++)
                        <tr>
                          <td>#</td>
                          <td>
                            <a>Pesamakini Backend UI</a>
                            <br />
                            <small>Created 01.01.2015</small>
                          </td>
                          <td>
                            <ul class="list-inline">
                              <li>
                                <img src="http://placehold.jp/150x150.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="http://placehold.jp/150x150.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="http://placehold.jp/150x150.png" class="avatar" alt="Avatar">
                              </li>
                              <li>
                                <img src="http://placehold.jp/150x150.png" class="avatar" alt="Avatar">
                              </li>
                            </ul>
                          </td>
                          <td class="project_progress">
                            <div class="progress progress_sm">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
                            </div>
                            <small>77% Complete</small>
                          </td>
                          <td>
                            <button type="button" class="btn btn-success btn-xs">Success</button>
                          </td>
                          <td>
                            <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                          </td>
                        </tr>
                        @endfor
                      </tbody>
                    </table>
                    <!-- end project list -->

                  </div>
                </div>
              </div>
            </div>
            {{-- Tabla de votaciones --}}

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

            {{-- Form Crear Votacion --}}

            <div class="x_panel">
                  <div class="x_title">
                    <h2>Nueva Votacion <small>Crea una nueva votacion</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" class="form-control" placeholder="Titulo de Votacion">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Subdominio" aria-describedby="newpoll-subdomain">
                                    <span class="input-group-addon" id="newpoll-subdomain">.larapoll.test/urna</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="message" required="required" class="form-control" name="message" rows="5" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                                    data-parsley-validation-threshold="10" placeholder="Descripcion breve de la Votacion"></textarea>
                            </div>
                        </div>
                        
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Autenticacion de Votantes
                                    <br>
                                    <small class="text-navy">Se recomienda Clave Unica.</small>
                                </label>
        
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat" checked="checked"> Clave Unica
                                    </label>
                                    </div>
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="flat"> Lista blanca
                                    </label>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Opciones de Votacion
                                <br>
                                <small class="text-navy">Se recomiendo encriptar.</small>
                            </label>
    
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat" checked="checked"> Encriptar Votantes
                                </label>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat"> Inicio Automatico
                                </label>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat"> Cierre Automatico
                                </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Inicio /Termino </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-inline">
                                <div class="input-group date col-md-12 col-lg-5" id="dtpk-start">
                                    <input type="text" class="form-control" readonly="readonly"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class="input-group date col-md-12 col-lg-5 pull-right" id="dtpk-end">
                                    <input type="text" class="form-control" readonly="readonly"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						   <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>

        {{-- Form Wizard --}}

        <poll-form-wizard></poll-form-wizard>

        {{-- End Form Wizard --}}


@endsection

@push('styles')
    <link rel="stylesheet" href="{{ secure_asset('css/votations.css') }}">
@endpush

@push('scripts')
    <script src="{{ secure_asset('js/votations.js') }}"></script>
    <script src="{{ secure_asset('js/votationsVue.js') }}"></script>

    <script type="text/javascript">
        
    </script>
@endpush