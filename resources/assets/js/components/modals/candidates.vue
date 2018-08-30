<template>
    <div :id="'cand-'+pollId" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Candidatos</h4>
            </div>
            <div class="modal-body">

                <div class="media" v-for="candidate in pollCandidates" :key="candidate.id" style="background-color: #efefef; padding: 1rem;">
                    <div class="media-left">
                        <img :src="'/storage/opt_img/'+candidate.image" class="media-object" style="width:90px; border-radius: 5rem;">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading" style="margin-bottom: 1.2rem;">
                            {{ candidate.name }}
                            <button v-on:click="deleteCandidate(candidate.id)" href="#" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o"></i> Eliminar </button>
                            <button class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target=".algo-raro"><i class="fa fa-pencil"></i> Editar </button>
                        </h4>
                        <p>
                            {{ candidate.description }}
                        </p>
                    </div>
                </div>

                <div class="media">
                    <div class="media-left">
                        
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input v-on:change="processFile" type='file' :id="'cand-imgup-'+pollId" accept=".png, .jpg, .jpeg" />
                                <label :for="'cand-imgup-'+pollId"></label>
                            </div>
                            <div class="avatar-preview">
                                <div :id="'img-prev-'+pollId" style="background-image: url(/images/placeholder.png); ">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="media-body" style="padding-right: 1rem;">
                        <h4 class="media-heading" style="margin-bottom: 1.2rem;">
                            <input v-model="name" type="text" placeholder="Nombre">
                            <button v-on:click="sendCandidate" class="btn btn-info btn-xs pull-right" data-toggle="modal" data-target=".algo-raro"><i class="fa fa-pencil"></i> Guardar </button>
                        </h4>
                        <p>
                            <textarea v-model="description" name="" id="" rows="3" placeholder="Descripcion" style="width: 100%;"></textarea>
                        </p>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            name: '',
            description: '',
            image: null
        }
    },
    props: [
        'pollId',
        'pollCandidates'
    ],
    methods: {
        sendCandidate(){
            let formData = new FormData();
            formData.append("poll_id", this.pollId);
            formData.append("name", this.name);
            formData.append("description", this.description);
            formData.append("image", this.image);

            axios.post('/api/storecandidate', formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.$emit('votation-modified');
                this.clearForm();
                console.log(response);
            }).catch(({response}) => {
                console.log(response);
            }).finally(() => {
                //
            });
        },
        clearForm(){  // TODO: Reset image preview
            this.name = '';
            this.description = '';
            this.image = null;
            document.getElementById('cand-imgup-'+this.pollId).value = "";
            document.getElementById('img-prev-'+vueRef.pollId).style.backgroundImage = 'url(/images/placeholder.png)';
            //$('#img-prev-'+this.pollId).css('background-image', 'url(/images/placeholder.png)');
        },
        processFile(event){
            this.image = event.target.files[0];
        },
        readURL(input) {
        let vueRef = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    let imgPreview = document.getElementById('img-prev-'+vueRef.pollId);
                    imgPreview.style.backgroundImage = 'url('+e.target.result +')';
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        deleteCandidate(id){
            axios.delete('/api/deletecandidate', {params: {poll_id: this.pollId, candidate_id: id}})
            .then(response => {
                this.$emit('votation-modified');
                console.log(response);
            }).catch(({response}) => {
                console.log(response);
            }).finally(() => {
                //
            });
        }
    },
    mounted(){
        let vueRef = this;
        
        let imgUploader = document.getElementById('cand-imgup-'+this.pollId);
        imgUploader.addEventListener('change', function() {
            vueRef.readURL(this);
        });
    }

}
</script>

<style>

    /* Image Uploader */
    .avatar-upload {
    position: relative;
    max-width: 205px;
    margin: auto;
    }
    .avatar-upload .avatar-edit {
    position: absolute;
    right: 0px;
    top: 0px;
    z-index: 1;
    }
    .avatar-upload .avatar-edit input {
    display: none;
    }
    .avatar-upload .avatar-edit input + label {
    display: inline-block;
    width: 34px;
    height: 34px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
    }
    .avatar-upload .avatar-edit input + label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
    }
    .avatar-upload .avatar-edit input + label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
    }
    .avatar-upload .avatar-preview {
    width: 100px;
    height: 100px;
    position: relative;
    border-radius: 100%;
    border: 6px solid #F8F8F8;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }
    .avatar-upload .avatar-preview > div {
    width: 100%;
    height: 100%;
    border-radius: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    }

</style>
