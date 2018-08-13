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


            <div id="wizardContainer" class="x_content">

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
                                    data-parsley-length="[5, 40]"
                                    v-model="formData.title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Direccion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="subdom-err">
                                <div class="input-group">
                                    <input type="text" id="subdom" class="form-control" placeholder="Subdominio" aria-describedby="newpoll-subdomain" required
                                        data-parsley-errors-container="#subdom-err"
                                        data-parsley-type="alphanum"
                                        data-parsley-length="[4, 18]"
                                        data-parsley-subdom-avail
                                        v-model="formData.subdomain"
                                        v-on:blur="isSubdomAvailable(formData.subdomain)"
                                        v-on:input="checkSubdom">
                                    <span class="input-group-addon" id="newpoll-subdomain">.larapoll.test/urna</span>
                                    
                                    <span v-if="!subdomLoading" id="subdom-check" :class="{ 'ok':subdomAvail, 'notok':!subdomAvail }"></span>
                                    <div v-if="subdomLoading" style="position: absolute; top: -85px; right: -16px;">
                                        <div class="spin-loader"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" placeholder="Descripcion breve de la Votacion" rows="5" required
                                    data-parsley-length="[40, 450]"
                                    v-model="formData.description"></textarea>
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
                                        <input type="radio" class="flat" value="whitelist" name="admition"> Lista Blanca
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" value="all" name="admition" checked> Todo el Mundo
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
                                    <input type="checkbox" class="flat" id="auth_cu" name="auth_type" checked="checked" required
                                        data-parsley-mincheck="1"
                                        data-parsley-errors-container="#auth-err"> Clave Unica
                                </label>
                                </div>
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" id="auth_email" name="auth_type"> Invitacion Por Email
                                </label>
                                </div>
                                <div class="icheckbox">
                                <label>
                                    <input type="checkbox" class="flat" id="auth_rut" name="auth_type"> Usando RUT <small>(Muy inseguro)</small>
                                </label>
                                </div>
                            </div>
                        </div>
        
                    </form>
                </div>

                <div id="step-4">
                    <form id="form-opt" class="form-horizontal form-label-left" style="padding: .5rem 0">
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

                                <div id="tp1-err" class="col-md-12 col-lg-5" style="padding: 0;">
                                    <div class="input-group date" style="width: 100%;" id="fw-dtpk-start">
                                        <input type="text" id="dtp-start" class="form-control" readonly="readonly"
                                            data-parsley-errors-container="#tp1-err"
                                            data-parsley-validate-if-empty
                                            data-parsley-valid-date="auto_start"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div id="tp2-err" class="col-md-12 col-lg-5 pull-right" style="padding: 0;">
                                    <div class="input-group date" style="width: 100%;" id="fw-dtpk-end">
                                        <input type="text" id="dtp-end" class="form-control" readonly="readonly"
                                            data-parsley-errors-container="#tp2-err"
                                            data-parsley-validate-if-empty
                                            data-parsley-valid-date="auto_end"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
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

        <!-- Request Loader -->
        <div id="requestLoader" class="sk-cube-grid" style="display: none;">
        <div class="sk-cube sk-cube1"></div>
        <div class="sk-cube sk-cube2"></div>
        <div class="sk-cube sk-cube3"></div>
        <div class="sk-cube sk-cube4"></div>
        <div class="sk-cube sk-cube5"></div>
        <div class="sk-cube sk-cube6"></div>
        <div class="sk-cube sk-cube7"></div>
        <div class="sk-cube sk-cube8"></div>
        <div class="sk-cube sk-cube9"></div>
        </div>

        <div>
        <div class="loader"></div>
        </div>
    </div>
</template>

<script>
/*
 *  BUGS:
 *      - DateTime Pickers no son restrinjidos si ambos estan activados y luego se activa y desactiva uno de ellos.
 *      -*FIXED* DateTimePickers: Estando activados, los valores son eliminados al retroceder de etapa en el form wizard y cambiar un valor de una etapa aterior.
 * 
 *  TODO: 
 *      - Agregar textos de ayuda y corregir faltas ortograficas.
 *      - Limpiar formulario al terminar una request exitosamente.
 */

    export default{
        data(){
            return{
                formData: { // otros inputs no incluidos por problemas con eventos inexistentes (culpa de plugins)
                    title: '',
                    subdomain: '',
                    description: '',
                },
                subdomLoading: false,   // muestra icono de carga
                subdomAvail: false,     // disponivilidad de ultimo dominio comprovado
                lastCheckedSubdom: '',  // guarda ultimo subdominio comprovado (evita repeticion)

                autoCheckTimeout: null, // Timeout que comprueba disponivilidad de subdominio cada 500 ms despues de input
                subdomChecked: true,    // detiene el avance mientras se comprueba subdominio

                submitingRequest: false, // muestra icono de carga
                dateTimeFormat: 'DD/MM/YYYY hh:mm A',
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
                    $('#form-basic #subdom').parsley().validate();
                });
            },

            submitPollRequest(){
                if (this.submitingRequest){console.log("** Waiting for other's request response **"); return false;}
                let requestData = {
                    title:          this.formData.title,
                    subdomain:      this.formData.subdomain,
                    description:    this.formData.description,
                    admition:       $('input[name=admition]:checked').val(),
                    auth_cu:        this.getCheckBoxValue('auth_cu'),
                    auth_email:     this.getCheckBoxValue('auth_email'),
                    auth_rut:       this.getCheckBoxValue('auth_rut'),
                    user_enc:       this.getCheckBoxValue('user_enc'),
                    start_active:   this.getCheckBoxValue('auto_start'),
                    start_datetime: (this.getCheckBoxValue('auto_start'))?$('#dtp-start').val().trim(): null,
                    end_active:     this.getCheckBoxValue('auto_end'),
                    end_datetime:   (this.getCheckBoxValue('auto_end'))?$('#dtp-end').val().trim(): null,
                };
                console.log(requestData);

                this.submitingRequest = true;
                $('#wizardContainer').block({
                    message: $('#requestLoader'),
                    css: { 
                        border: 'none', 
                        padding: '15px', 
                        backgroundColor: 'rgba(0, 0, 0, 0.0)', 
                        '-webkit-border-radius': '10px', 
                        '-moz-border-radius': '10px', 
                        opacity: .5
                    },
                    overlayCSS: { 
                        backgroundColor: '#fff', 
                        opacity: 1, 
                        cursor: 'wait' 
                    },
                });

                axios.post('/api/storepoll', requestData)
                .then(response => {
                    new PNotify({
                        title: 'Votacion Creada',
                        text: 'Has creado exitosamente una nueva votación, asegúrate de revisar las configuraciones.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });
                    console.log(response);
                }).catch(({response}) => {
                    new PNotify({
                        title: 'Ha ocurrido un problema.',
                        text: 'Por favor intente recargar la pagina. Si el error persiste contacte con el administrador.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });
                    console.log(response);
                }).finally(() => {
                    this.submitingRequest = false;
                    $('#wizardContainer').unblock();
                });
            },

            checkSubdom(){ // Activa comprovacion de subdominio (en input)
                this.subdomChecked = false;
                if (this.autoCheckTimeout != null){
                    clearTimeout(this.autoCheckTimeout);
                }
                this.autoCheckTimeout = setTimeout(() => {
                    this.isSubdomAvailable(this.formData.subdomain);
                }, 500);
            },

            initializeTimePickControl(){ // Control del acceso a los DateTimePickers
                let initEnabStart = $('input#auto_start').prop('checked');
                let initEnabEnd = $('input#auto_end').prop('checked');

                $('#fw-dtpk-start input').prop( 'disabled', !initEnabStart );
                $('#fw-dtpk-start input').val((!initEnabStart)?'Inicio Manual':'');
                $('#fw-dtpk-end input').prop( 'disabled', !initEnabEnd );
                $('#fw-dtpk-end input').val((!initEnabEnd)?'Termino Manual':'');

                function clearDTPickerRestrictions(){
                    $('#fw-dtpk-start').data("DateTimePicker").maxDate(false);
                    $('#fw-dtpk-end').data("DateTimePicker").minDate(false);
                    $('#fw-dtpk-start').data("DateTimePicker").clear();
                }

                let vueRef = this;
                $('input#auto_start').on('ifToggled', function (event) {
                    let enableAutoStart = $(this).prop('checked');
                    $('#fw-dtpk-start input').prop( 'disabled', !enableAutoStart );
                    if (!enableAutoStart){clearDTPickerRestrictions()}
                    $('#fw-dtpk-start input').val((!enableAutoStart)?'Inicio Manual':'');
                });
                $('input#auto_end').on('ifToggled', function (event) {
                    let enableAutoEnd = $(this).prop('checked');
                    $('#fw-dtpk-end input').prop( 'disabled', !enableAutoEnd );
                    if (!enableAutoEnd){clearDTPickerRestrictions()}
                    $('#fw-dtpk-end input').val((!enableAutoEnd)?'Termino Manual':'');
                });

                $("#fw-dtpk-start").on("dp.change", function (e) {
                    $('#fw-dtpk-end').data("DateTimePicker").minDate(e.date);
                });
                $("#fw-dtpk-end").on("dp.change", function (e) {
                    $('#fw-dtpk-start').data("DateTimePicker").maxDate(e.date);
                });
            },

            getCheckBoxValue(id){
                return $('#'+id).prop('checked');
            }
        },
        mounted(){
            var vueRef = this; // referencia al contexto del componente Vue
            $(document).ready(function(){

                /*Date Time Pickers SetUp*/
                $('#fw-dtpk-start').datetimepicker({
                    format: vueRef.dateTimeFormat,
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    locale: 'es',
                    useCurrent: false,
                });
                $('#fw-dtpk-end').datetimepicker({
                    format: vueRef.dateTimeFormat,
                    ignoreReadonly: true,
                    allowInputToggle: true,
                    locale: 'es',
                    useCurrent: false,
                });
                vueRef.initializeTimePickControl();

                /*Parsley SetUp*/
                window.Parsley
                .addValidator('subdomAvail', {
                    validateString: function(value, requirement) {
                        return vueRef.subdomAvail;
                    },
                    messages: {
                        es: 'La dirección no esta disponible.',
                    }
                });

                window.Parsley
                .addValidator('validDate', {
                    requirementType: 'string',
                    validateString: function(value, requirement) {
                        if (!$('#'+requirement).prop('checked')){return true;}
                        return moment(value.trim(), vueRef.dateTimeFormat, true).isValid();
                    },
                    messages: {
                        es: 'Necesita espesificar una fecha valida.',
                    }
                });

                let formBasic = $('#form-basic').parsley();
                let formAuth = $('#form-auth').parsley();
                let formOptions = $('#form-opt').parsley();

                /*Smart Wizard SetUp */

                // validaciones de cada etapa de Smart Wizard
                let validateStep = function(step) {
                    if (step == 1){
                        let formValid = formBasic.validate();
                        return (formValid 
                            && vueRef.subdomAvail 
                            && vueRef.subdomChecked);
                    } else if (step == 2){ // Nada que validar
                        return true;
                    } else if (step == 3){
                        return formAuth.validate();
                    } else if(step == 4) {
                        return formOptions.validate();
                    } else{
                        return false;
                    }
                };

                let newPollWizard = $('#smartwizard');

                // Llamado al cambiar de Paso
                let validateNextStep = function(event, direction) {
                    let from = direction.fromStep;
                    if (from >= direction.toStep){return true;} // No validar si retrocede
                    return validateStep(from);
                };

                // LLamado al terminar 
                let finishNewPoll = function(event, direction) {
                    for (let stepNum = 1; stepNum <= 4; stepNum++) { // comprueba todos los inputs una ultima vez
                        if (!validateStep(stepNum)){
                            if (stepNum != newPollWizard.smartWizard('currentStep')){
                                newPollWizard.smartWizard('goToStep', stepNum);
                            }
                            return false; // terminar funcion en primer error encontrado
                        }
                    }
                    vueRef.submitPollRequest();
                    return false;
                }

                newPollWizard.smartWizard({
                    labelNext: 'Siguiente',
                    labelPrevious: 'Anterior',
                    labelFinish: 'Terminar',
                    onLeaveStep: validateNextStep,
                    onFinish: finishNewPoll
                });

            });
        }
    }
</script>

<style lang="css">
    /*SmartWizard FIX*/
    .stepContainer{overflow: visible !important; height: auto !important;}
    .actionBar a.btn{float: right;}

    /*Estilos para indicador de disponivilidad de subdominio*/
    #subdom-check{
        height: 14px;
        width: 14px;
        position: absolute;
        border-radius: 7px;
        right: -2rem;
        top: .8rem;
        display: none;
    }

    #subdom-check.ok, #subdom-check.notok{
        animation-name: bounce;
        animation-duration: .2s;
        animation-fill-mode: forwards;
        display: inherit;
    }

    #subdom-check.ok{
        background-color: #2ecc71;
        border: 1px solid #95a5a6;
    }
    #subdom-check.notok{
        background-color: #e74c3c;
        border: 1px solid #95a5a6;
    }

    @keyframes bounce {
        0% {
            transform: scale(.2,.2);
        }
        80% {
            transform: scale(1.2,1.2);
        }
        100% {
            transform: scale(1,1);
        }
    }

    /*Loader para verificar subdominio*/
    .spin-loader {
        color: #000;
        font-size: 3px;
        margin: 100px auto;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        position: relative;
        text-indent: -9999em;
        -webkit-animation: load4 1.3s infinite linear;
        animation: load4 1.3s infinite linear;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        }
        @-webkit-keyframes load4 {
        0%,
        100% {
            box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
        }
        12.5% {
            box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        25% {
            box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        37.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        50% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        62.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
        }
        75% {
            box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
        }
        87.5% {
            box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
        }
        }
        @keyframes load4 {
        0%,
        100% {
            box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
        }
        12.5% {
            box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        25% {
            box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        37.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        50% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        62.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
        }
        75% {
            box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
        }
        87.5% {
            box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
        }
    }

    /* Loader para Request de Votacion */
    .sk-cube-grid {
    width: 80px;
    height: 80px;
    margin: 100px auto;
    }

    .sk-cube-grid .sk-cube {
    width: 33%;
    height: 33%;
    background-color: #27ae60;
    float: left;
    -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
    }
    .sk-cube-grid .sk-cube1 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
    .sk-cube-grid .sk-cube2 {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
    .sk-cube-grid .sk-cube3 {
    -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s; }
    .sk-cube-grid .sk-cube4 {
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
    .sk-cube-grid .sk-cube5 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
    .sk-cube-grid .sk-cube6 {
    -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
    .sk-cube-grid .sk-cube7 {
    -webkit-animation-delay: 0s;
            animation-delay: 0s; }
    .sk-cube-grid .sk-cube8 {
    -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
    .sk-cube-grid .sk-cube9 {
    -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }

    @-webkit-keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
        -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
    } 35% {
        -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1); 
    }
    }

    @keyframes sk-cubeGridScaleDelay {
    0%, 70%, 100% {
        -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
    } 35% {
        -webkit-transform: scale3D(0, 0, 1);
                transform: scale3D(0, 0, 1);
    } 
    }

</style>