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
                                        v-on:blur="isSubdomAvailable(formData.subdomain)"
                                        v-on:input="checkSubdom">
                                    <span class="input-group-addon" id="newpoll-subdomain">.larapoll.test/urna</span>
                                    <!--  --> <span v-if="!subdomLoading" id="subdom-check" :class="{ 'ok':subdomAvail, 'notok':!subdomAvail }"></span>
                                    <div  v-if="subdomLoading" class="sk-folding-cube subdom-load">
                                        <div class="sk-cube1 sk-cube"></div>
                                        <div class="sk-cube2 sk-cube"></div>
                                        <div class="sk-cube4 sk-cube"></div>
                                        <div class="sk-cube3 sk-cube"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" placeholder="Descripcion breve de la Votacion" rows="5" required
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
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" name="phold2" checked="checked" required
                                        data-parsley-mincheck="1"
                                        data-parsley-errors-container="#auth-err"> Clave Unica
                                </label>
                                </div>
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" name="phold2"> Invitacion Por Email
                                </label>
                                </div>
                                <div class="icheckbox">
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
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" id="user_enc" checked="checked"> Encriptar Votantes
                                </label>
                                </div>
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" id="auto_start"> Inicio Automatico
                                </label>
                                </div>
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" id="auto_end"> Termino Automatico
                                </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Inicio /Termino </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-inline">
                                <div class="input-group date col-md-12 col-lg-5" id="fw-dtpk-start">
                                    <input type="text" class="form-control" v-model="formData.start_date" readonly="readonly"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class="input-group date col-md-12 col-lg-5 pull-right" id="fw-dtpk-end">
                                    <input type="text" class="form-control" v-model="formData.end_date" readonly="readonly"/>
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
                subdomLoading: false,
                subdomAvail: false,
                lastCheckedSubdom: '',

                autoCheckTimeout: null,
                subdomChecked: true,
            }
        },
        methods: {
            isSubdomAvailable(subdom){ // Comprueba si subdominio esta disponible
                let trimedSubdom = subdom.trim();
                let lenNotAllowed = (trimedSubdom.length < 4 || trimedSubdom.length > 18);
                if (lenNotAllowed){
                    this.subdomAvail = false;
                }
                if (!trimedSubdom || this.lastCheckedSubdom == trimedSubdom || lenNotAllowed) {
                    this.subdomChecked = true;
                    return false;
                }
                this.subdomLoading = true;
                this.lastCheckedSubdom = trimedSubdom
                
                axios.get('/api/subdomav/'+trimedSubdom)
                .then(response => {
                    this.subdomAvail = response.data.available;
                    console.log(response);
                }).catch(({response}) => {
                    this.subdomAvail = false;
                    console.log(response);
                }).finally(() => {
                    this.subdomLoading = false;
                    this.subdomChecked = true;
                });
            },
            checkSubdom(){
                this.subdomChecked = false;
                if (this.autoCheckTimeout != null){
                    clearTimeout(this.autoCheckTimeout);
                }
                this.autoCheckTimeout = setTimeout(() => {
                    this.isSubdomAvailable(this.formData.subdomain);
                }, 500);
            },
            initializeTimePickControl(){
                let initEnabStart = $('input#auto_start').prop('checked');
                let initEnabEnd = $('input#auto_end').prop('checked');

                $('#fw-dtpk-start input').prop( 'disabled', !initEnabStart );
                $('#fw-dtpk-end input').prop( 'disabled', !initEnabEnd );
                this.formData.start_date = (!initEnabStart)?'Inicio Manual':'';
                this.formData.end_date = (!initEnabEnd)?'Termino Manual':'';

                let vueRef = this;
                $('input#auto_start').on('ifToggled', function (event) {
                    let enableAutoStart = $(this).prop('checked');
                    $('#fw-dtpk-start input').prop( 'disabled', !enableAutoStart );
                    //vueRef.formData.start_date = (!enableAutoStart)?'Inicio Manual':'';
                    $('#fw-dtpk-start input').val((!enableAutoStart)?'Inicio Manual':'');
                    if (!enableAutoStart){
                        $('#fw-dtpk-end').data("DateTimePicker").minDate(false);
                        $('#fw-dtpk-start').data("DateTimePicker").clear();
                    }
                    console.log('hey you changed auto_start');
                });
                $('input#auto_end').on('ifToggled', function (event) {
                    let enableAutoEnd = $(this).prop('checked');
                    $('#fw-dtpk-end input').prop( 'disabled', !enableAutoEnd );
                    //vueRef.formData.end_date = (!enableAutoEnd)?'Termino Manual':'';
                    $('#fw-dtpk-end input').val((!enableAutoEnd)?'Inicio Manual':'');
                    if (!enableAutoEnd){
                        $('#fw-dtpk-start').data("DateTimePicker").maxDate(false);
                        $('#fw-dtpk-end').data("DateTimePicker").clear();
                    }
                    console.log('hey you changed auto_end');
                });
            },
            getCheckBoxValue(id){
                return $('#'+id).prop('checked');
            }
        },
        mounted(){
            var vueRef = this; // referencia al contexto del componente Vue
            $(document).ready(function(){

                /*Date Time Pickers */
                $('#fw-dtpk-start').datetimepicker({
                    format: 'DD/MM/YYYY hh:mm A',
                    ignoreReadonly: true,
                    allowInputToggle: true,
                });
                $('#fw-dtpk-end').datetimepicker({
                    format: 'DD/MM/YYYY hh:mm A',
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    useCurrent: false,
                });
                $("#fw-dtpk-start").on("dp.change dp.hide", function (e) {
                    $('#fw-dtpk-end').data("DateTimePicker").minDate(e.date);
                });
                $("#fw-dtpk-end").on("dp.change dp.hide", function (e) {
                    $('#fw-dtpk-start').data("DateTimePicker").maxDate(e.date);
                });

                /*Validacion de Input con Parsley*/
                let formBasic = $('#form-basic').parsley();
                let formAuth = $('#form-auth').parsley();

                let validateNewPoll = function(event, direction) {
                    let from = direction.fromStep;
                    if (from >= direction.toStep){return true;} // No validar si retrocede
                    if (from == 1){
                        let formValid = formBasic.validate();
                        return (formValid 
                            && vueRef.subdomAvail 
                            && vueRef.subdomChecked);
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

                vueRef.initializeTimePickControl();
            });
        }
    }
</script>

<style lang="css">
    /*SmartWizard FIX*/
    .stepContainer{overflow: visible !important; height: auto !important;}
    .actionBar a.btn{float: right;}

    #subdom-check{
        height: 14px;
        width: 14px;
        position: absolute;
        border-radius: 7px;
        right: -2rem;
        top: .8rem;
        display: none;
    }
    #subdom-check.ok{background-color: #2ecc71; display: inherit;}
    #subdom-check.notok{background-color: #c0392b;  display: inherit;}

    /*Loader*/
    .subdom-load {
            position: absolute !important;
            top: -12px;
            right: -25px;
    }

    .sk-folding-cube {
    margin: 20px auto;
    width: 14px;
    height: 14px;
    position: relative;
    -webkit-transform: rotateZ(45deg);
            transform: rotateZ(45deg);
    }

    .sk-folding-cube .sk-cube {
    float: left;
    width: 50%;
    height: 50%;
    position: relative;
    -webkit-transform: scale(1.1);
        -ms-transform: scale(1.1);
            transform: scale(1.1); 
    }
    .sk-folding-cube .sk-cube:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #333;
    -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
            animation: sk-foldCubeAngle 2.4s infinite linear both;
    -webkit-transform-origin: 100% 100%;
        -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
    }
    .sk-folding-cube .sk-cube2 {
    -webkit-transform: scale(1.1) rotateZ(90deg);
            transform: scale(1.1) rotateZ(90deg);
    }
    .sk-folding-cube .sk-cube3 {
    -webkit-transform: scale(1.1) rotateZ(180deg);
            transform: scale(1.1) rotateZ(180deg);
    }
    .sk-folding-cube .sk-cube4 {
    -webkit-transform: scale(1.1) rotateZ(270deg);
            transform: scale(1.1) rotateZ(270deg);
    }
    .sk-folding-cube .sk-cube2:before {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
    }
    .sk-folding-cube .sk-cube3:before {
    -webkit-animation-delay: 0.6s;
            animation-delay: 0.6s; 
    }
    .sk-folding-cube .sk-cube4:before {
    -webkit-animation-delay: 0.9s;
            animation-delay: 0.9s;
    }
    @-webkit-keyframes sk-foldCubeAngle {
    0%, 10% {
        -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
        opacity: 0; 
    } 25%, 75% {
        -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
        opacity: 1; 
    } 90%, 100% {
        -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
        opacity: 0; 
    } 
    }

    @keyframes sk-foldCubeAngle {
    0%, 10% {
        -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
        opacity: 0; 
    } 25%, 75% {
        -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
        opacity: 1; 
    } 90%, 100% {
        -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
        opacity: 0; 
    }
    }

</style>