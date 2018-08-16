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