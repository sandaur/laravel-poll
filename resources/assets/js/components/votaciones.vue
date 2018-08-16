<template>
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
                    <th style="width: 20%">Votacion</th>
                    <th>Candidatos</th>
                    <th>Inicio /Termino</th>
                    <th>Estado</th>
                    <th style="width: 20%">Modificar</th>
                </tr>
                </thead>
                <tbody>
                
                
                <tr v-for="poll in polls" :key="poll.id">
                    <td>#</td>
                    <td>
                        <a>{{ poll.title }}</a>
                        <br />
                        <small>{{ timeCue(poll) }}</small>
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
                        <small class="label label-default"><i class="fa fa-play" style="margin-right: 1rem"></i>{{ poll.setting.start_time?poll.setting.start_time:'Inicio Manual' }}</small> <br>
                        <small class="label label-default"><i class="fa fa-pause" style="margin-right: 1rem"></i>{{ poll.setting.end_time?poll.setting.end_time:'Termino Manual' }}</small>
                    </td>
                    <td>

                        <div class="btn-group">
                            <button type="button" class="btn btn-xs dropdown-toggle" :class="statusClass(poll)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i>{{ poll.status }}</i> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Terminar</a></li>
                            </ul>
                        </div>

                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Estadisticas </a>
                        <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" :data-target="'#del-'+poll.id"><i class="fa fa-trash-o"></i> Eliminar </a>
                        <modalDelete
                            :poll-name="poll.title"
                            :poll-id="poll.id"
                            v-on:poll-deleted="updatePolls">
                            </modalDelete>
                    </td>
                </tr>
                
                
                </tbody>
            </table>
            <!-- end project list -->

            </div>
        </div>
        </div>
    </div>
</template>

<script>
import modalDelete from './modals/deleteVotation.vue';

export default {
    data(){
        return{
            polls: {},
            loadingPolls: false,
            serverTimeFormat: 'YYYY-MM-DD hh:mm:ss',
        }
    },
    methods: {
        updatePolls(){
            this.loadingPolls = true;
            axios.get('/api/getpolls')
            .then(response => {
                this.polls = response.data.votations;
                console.log(response);
            }).catch(({response}) => {
                console.log(response);
            }).finally(() => {
                this.loadingPolls = false;
            });
        },

        timeCue(poll){
            if (poll.status == 'waiting'){
                if (poll.setting.start_time === null){
                    return 'Inicio Manual';
                } else{
                    let timeDif = moment(poll.setting.start_time, this.serverTimeFormat).fromNow();
                    return 'Inicia '+timeDif;
                }
            } else if (poll.status == 'closed'){
                return 'Finalizada';
            } else{
                if (poll.setting.end_time === null){
                    return 'Termino Manual';
                } else{
                    let timeDif = moment(poll.setting.end_time, this.serverTimeFormat).fromNow();
                    return 'Termina '+timeDif;
                }
            }
        },

        statusClass(poll){
            if (poll.status == 'open'){
                return 'btn-success';
            } else if (poll.status == 'closed'){
                return 'btn-danger';
            } else if (poll.status == 'waiting'){
                return 'btn-warning';
            }
        }
    },
    components: {
        modalDelete
    },
    mounted(){
        this.updatePolls();
    }
}
</script>

<style>

</style>
