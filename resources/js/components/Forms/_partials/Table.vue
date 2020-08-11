<template>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatables-style" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" data-priority="1">ID</th>
                    <th scope="col" data-priority="2">Nome</th>
                    <th scope="col">Whatsapp</th>
                    <th scope="col">Resultado</th>
                    <th scope="col">Data Registro</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                 <tr v-for="(record, index) in forms.data" :key="index">
                    <td scope="row">{{record.id}}</td>
                    <td>{{record.user.name}}</td>
                    <td>{{record.user.whatsapp_number}}</td>
                    <td>{{record.result_text}}</td>
                    <td>{{record.created_at}}</td>
                    <td nowrap>
                        <a class="btn btn-secondary btn-sm" href="#" v-on:click="loadForm(record.id)" role="button" title="Visualizar Formulário" alt="Visualizar Formulário" data-toggle="modal" data-target="#modal-edit-view"><i class="icon fas fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" v-on:click="removeElement(record.id)" role="button" title="Remover Formulário" alt="Remover Formulário"><i class="icon fas fa-trash"></i></a>
                        <a v-if="record.user.whatsapp_number" class="btn btn-success btn-sm" :href="getUrlWhats(record.user.whatsapp_number)" target="_blank" role="button" title="Enviar Mensagem" alt="Enviar Mensagem"><i class="icon fab fa-whatsapp"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="modal-edit-view" tabindex="-1" role="dialog" aria-labelledby="modal-edit-view" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">
                            <i class="icon mr-2 fas fa-eye"></i>
                            <span v-if="loading">Carregando...</span>
                            <span v-else>Formulário de Consulta:</span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form v-if="!loading && form">
                        <div class="modal-body">
                            <ul class="list-group mb-3">
                                <li class="list-group-item active"><i class="icon mr-2 fas fa-user"></i>{{form.user.name}}</li>
                                <li v-if="form.user.whatsapp_number" class="list-group-item">
                                    <i class="icon mr-2 fab fa-whatsapp text-success"></i>
                                    <a :href="getUrlWhats(form.user.whatsapp_number)" target="_blank" title="Enviar Mensagem" alt="Enviar Mensagem">{{form.user.whatsapp_number}}</a>
                                </li>
                                <li class="list-group-item">Data de Consulta: {{ form.created_at }}</li>
                                <li class="list-group-item">Resultado: <b>{{form.result_text}}</b></li>
                            </ul>
                            <ul class="list-group">
                                <li class="list-group-item active"><i class="icon mr-2 fas fa-briefcase-medical"></i>Sintomas Analizados:</li>
                                <li class="list-group-item">Febre? <b>{{form.fever}}</b></li>
                                <li class="list-group-item">Coriza? <b>{{form.coryza}}</b></li>
                                <li class="list-group-item">Nariz Entupido? <b>{{form.stuffy_nose}}</b></li>
                                <li class="list-group-item">Cansaço? <b>{{form.tiredness}}</b></li>
                                <li class="list-group-item">Tosse? <b>{{form.cough}}</b></li>
                                <li class="list-group-item">Dor de Cabeça? <b>{{form.headache}}</b></li>
                                <li class="list-group-item">Dores no Corpo? <b>{{form.body_aches}}</b></li>
                                <li class="list-group-item">Mal estar em geral? <b>{{form.general_discomfort}}</b></li>
                                <li class="list-group-item">Dor de garganta? <b>{{form.sore_throat}}</b></li>
                                <li class="list-group-item">Dificuldade de respirar? <b>{{form.dyspnea}}</b></li>
                                <li class="list-group-item">Falta de paladar? <b>{{form.lack_of_taste}}</b></li>
                                <li class="list-group-item">Falta de olfato? <b>{{form.loss_of_smell}}</b></li>
                                <li class="list-group-item">Dificuldade de locomoção? <b>{{form.locomotion_difficulty}}</b></li>
                                <li class="list-group-item">Diarreia? <b>{{form.diarrhea}}</b></li>
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Sair</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>

import { mapActions, mapState} from 'vuex';

export default {

    props: ['forms'],

    data() {
        return {
            loading: false
        }
    },

    computed: {
        ...mapState({
            form: state => state.forms.form,
        }),
    },

    methods: {

        ...mapActions([
            'removeForm',
            'getForms',
            'getForm'
        ]),

        loadForms(){
            this.loading = true;
            this.getForms()
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar formulários!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        loadForm(id){
            this.loading = true;
            this.getForm(id)
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar formulário!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        removeElement(id){
            this.$swal.fire({
                title: '',
                text: "Realmente Deseja Executar esta ação? Esta ação não poderá ser desfeita!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, remover registro!',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#38c172',
                cancelButtonColor: '#6c757d',
            }).then((result) => {

                if (result.value) {
                    this.removeForm(id)
                        .then(response => {
                            Vue.$toast.open({ message: 'Formulário removido com sucesso!', type: 'success',  position: 'top-right'});
                            this.loadForms()
                        })
                        .catch(error => {
                            Vue.$toast.open({ message: 'Erro ao remover Formulário!', type: 'error',  position: 'top-right'})
                            this.loadForms()
                        })
                }
            })
        },

        getUrlWhats(number){
            var number = number.replace(/[^\d]+/g,'');
            var url = `https://api.whatsapp.com/send?phone=55${number}&text=Ol%C3%A1!%20Tudo%20bem%3F`
            return url
        }
    },
    
}
</script>