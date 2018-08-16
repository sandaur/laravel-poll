 <template>
     <div :id="'del-'+pollId" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Eliminar <b>{{ pollName }}</b></h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-3 center" style="text-align: center; font-size: 5rem">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </div>

                    <div class="col-xs-9">
                        <p>
                            Toda la informacion relacionada ha esta votacion se perdera de forma permanente.
                            ¿Esta seguro de que desea eliminar esta votacion?
                        </p>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" v-on:click="deletePoll">Eliminar</button>
            </div>

            </div>
        </div>
    </div>
 </template>
 
 <script>
 export default {
    props: [
        'pollName',
        'pollId',
    ],
    methods: {
        deletePoll(){
            axios.delete('/api/deletepoll', {params: {id: this.pollId}})
            .then(response => {
                new PNotify({
                    title: 'Votacion Eliminada',
                    text: 'Todos los datos relacionados a la votacion se han eliminado de forma exitosa.',
                    type: 'success',
                    styling: 'bootstrap3'
                });
                console.log(response);
            }).catch(({response}) => {
                new PNotify({
                    title: 'Ha ocurrido un error',
                    text: 'Ha ocurrido un error al intentar eliminar la votacion.',
                    type: 'danger',
                    styling: 'bootstrap3'
                });
                console.log(response);
            }).finally(() => {
                this.$emit('poll-deleted');
                $('#del-'+this.pollId).modal('hide');
            });
        }
    }
 }
 </script>
 
 <style>
 
 </style>
 