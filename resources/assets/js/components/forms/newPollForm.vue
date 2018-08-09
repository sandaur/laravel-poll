<template>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Form Wizards <small>Sessions</small></h2>
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

            <!-- Smart Wizard -->
            <div id="smartwizard" class="form_wizard wizard_horizontal">
                <ul class="wizard_steps">
                    <li>
                        <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                                            Paso 1<br />
                                            <small>Informacion Basica</small>
                                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                                            Paso 2<br />
                                            <small>Votantes Admitidos</small>
                                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                        <span class="step_no">3</span>
                        <span class="step_descr">
                                            Paso 3<br />
                                            <small>Autenticacion de Votantes</small>
                                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                        <span class="step_no">4</span>
                        <span class="step_descr">
                                            Paso 4<br />
                                            <small>Opciones Adicionales</small>
                                        </span>
                        </a>
                    </li>
                </ul>
                
                <div id="step-1">
                    <form id="form-basic" class="form-horizontal form-label-left" style="padding: .5rem 0">
                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2>Informacion Basica</h2>
                                <p class="text-justify">
                                    Para crear una votacion necesitas un titulo que describa o identifique el proposito del sufragio. 
                                    La forma en que los votantes accederan a la urna virtual sera a traves de un subdomio que tu escojeras.
                                    Si deseas proporcionar un poco de informacion extra para dar contexto a la situacion de forma breve, puedes proporcionar una descripcion.
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Titulo <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="pley-name" type="text" class="form-control" placeholder="Titulo de Votacion" required
                                    data-parsley-type="alphanum"
                                    data-parsley-length="[5, 40]">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="subdom-err">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Subdominio" aria-describedby="newpoll-subdomain" required
                                        data-parsley-errors-container="#subdom-err"
                                        data-parsley-type="alphanum"
                                        data-parsley-length="[4, 18]"
                                        v-model="formData.subdomain"
                                        v-on:click="isSubdomAvailable(formData.subdomain)">
                                    <span class="input-group-addon" id="newpoll-subdomain">.larapoll.test/urna</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" placeholder="Descripcion breve de la Votacion" rows="5" required
                                    data-parsley-trigger="keyup"
                                    data-parsley-validation-threshold="10"
                                    data-parsley-length="[40, 450]"></textarea>
                            </div>
                        </div>

                    </form>
                </div>

                <div id="step-2">
                    <form class="form-horizontal form-label-left" style="padding: .5rem 0">
                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2>Votantes Admitidos</h2>
                                <p class="text-justify">
                                    Los votantes que ingresen a la urna virtual tendran que comprobar su identidad de alguna forma,
                                    para ello el sistema cuenta con dos formas de determinar la identidad de un votante. Utilizando 
                                    Clave Unica el votante tendra que ingresar usando el sistema de autenticacion de Clave Unica. 
                                    La otra forma de comprobar la identidad del votante es mediante una invitacion enviada directamente 
                                    al correo electronico del votante(esta opcion solo estara disponible si se ingresan previamente los 
                                    correos de los votantes).
                                </p>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Admicion Para
                                <br>
                                <small class="text-navy">Se recomienda Lista Blanca.</small>
                            </label>
        
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" checked name="pholder"> Lista Blanca
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="pholder"> Todo el Mundo
                                    </label>
                                </div>
                            </div>
                        </div>
        
                    </form>
                </div>
                
                <div id="step-3">
                    <form id="form-auth" class="form-horizontal form-label-left" style="padding: .5rem 0" data-parsley-validate>
                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2>Autenticacion de Votantes</h2>
                                <p class="text-justify">
                                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam ullam corrupti
                                        molestias amet consectetur fuga debitis sed, accusantium et mollitia perspiciatis
                                        repudiandae natus nostrum cum eos maiores at temporibus quidem minus quis quasi? 
                                        Libero eveniet numquam dolorum exercitationem nemo dignissimos. Lorem ipsum dolor, 
                                        sit amet consectetur adipisicing elit. Quis, quaerat.
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Autenticacion de Votantes
                                <br>
                                <small class="text-navy">Se recomienda Clave Unica.</small>
                            </label>
        
                            <div id="auth-err" class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat" name="phold2" checked="checked" required
                                        data-parsley-mincheck="1"
                                        data-parsley-errors-container="#auth-err"> Clave Unica
                                </label>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat" name="phold2"> Invitacion Por Email
                                </label>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="flat" name="phold2"> Usando RUT <small>(Muy inseguro)</small>
                                </label>
                                </div>
                            </div>
                        </div>
        
                    </form>
                </div>

                <div id="step-4">
                    <form class="form-horizontal form-label-left" style="padding: .5rem 0">
                        <div class="form-group">
                            <div class="control-label col-md-3 col-sm-3 col-xs-12"></div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2>Opciones Adicionales</h2>
                                <p class="text-justify">
                                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam ullam corrupti
                                    molestias amet consectetur fuga debitis sed, accusantium et mollitia perspiciatis
                                    repudiandae natus nostrum cum eos maiores at temporibus quidem minus quis quasi? 
                                    Libero eveniet numquam dolorum exercitationem nemo dignissimos.
                                </p>
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
                                <div class="input-group date col-md-12 col-lg-5" id="fw-dtpk-start">
                                    <input type="text" class="form-control" readonly="readonly"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class="input-group date col-md-12 col-lg-5 pull-right" id="fw-dtpk-end">
                                    <input type="text" class="form-control" readonly="readonly"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
        
                    </form>
                </div>

            </div>
            <!-- End SmartWizard Content -->
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                formData: {
                    title: '',
                    subdomain: '',
                    description: '',
                    admition: '',
                    auth_type: '',
                    user_enc: true,
                    auto_start: false,
                    auto_end: false,
                    start_date: '',
                    end_date: ''
                },
            }
        },
        methods: {
            isSubdomAvailable(subdom){ // Comprueba si subdominio esta disponible
                if (!subdom.trim()) {return false;}
                axios.get('/api/subdomav/'+subdom).then(response => {
                    console.log(response);
                }).catch(({response}) => {
                    console.log(response);
                });
            }
        },
        mounted(){
            $(document).ready(function(){
                let datePickerConf = {
                    format: 'DD/MM/YYYY hh:mm A',
                    ignoreReadonly: true,
                    allowInputToggle: true
                };
                
                $('#fw-dtpk-start').datetimepicker(datePickerConf);
                $('#fw-dtpk-end').datetimepicker(datePickerConf);

                /*Validacion de Input con Parsley*/
                let formBasic = $('#form-basic').parsley();
                let formAuth = $('#form-auth').parsley();

                let validateNewPoll = function(event, direction) {
                    let from = direction.fromStep;
                    if (from >= direction.toStep){return true;}
                    if (from == 1){
                        return formBasic.validate();
                    } else if (from == 2){ // Nada que validar
                        return true;
                    } else if (from == 3){
                        return formAuth.validate();
                    } else{
                        return false;
                    }
                };

                let finishNewPoll = function(event, direction) {
                    console.log('It finished');
                    return false;
                }

                $('#smartwizard').smartWizard({
                    labelNext: 'Siguiente',
                    labelPrevious: 'Anterior',
                    labelFinish: 'Terminar',
                    onLeaveStep: validateNewPoll,
                    onFinish: finishNewPoll
                });
            });
        }
    }
</script>

<style lang="css">
    /*SmartWizard FIX*/
    .stepContainer{overflow: hidden; height: auto !important;}
    .actionBar a.btn{float: right;}
</style>