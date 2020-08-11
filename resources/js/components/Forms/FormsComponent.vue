<template>
     <div>
        <div class="button-group">
            <a class="btn btn-success mb-3" href="#" role="button" alt="preencher formulário" title="Preencher Novo Formulário" data-toggle="modal" data-target="#modal-add-view"><i class="icon fas fa-plus"></i> Preencher Novo Formulário</a>
            <a class="btn btn-secondary mb-3" href="users" role="button" alt="adicionar usuário" title="Adicionar Usuário"><i class="icon fas fa-user-plus"></i> Adicionar Novo Usuário</a>
        </div>

        <div id="accordion">
            <div class="card">
                <div class="card-header p-3" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h6 class="mb-0">
                        <i class="icon fas fa-th-list"></i>
                        Formulários Preenchidos
                    </h6>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" data-js="div">
                    <div v-if="forms.data> 0 && !loading" class="card-body">
                        <Table :forms="forms"></Table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-add-view" tabindex="-1" role="dialog" aria-labelledby="modal-add-view" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">
                            <i class="icon mr-2 fas fa-th-list"></i>
                            <span>Preencher Formulário</span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-add" v-on:submit.prevent="addForm">
                        <div class="modal-body">
                            <FormAdd :clear="clear" :users="users" :loading="loading"></FormAdd>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" :disabled="active_button_add_form"><i class="icon fas fa-plus"></i> Registrar</button>
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
import Table from './_partials/Table'
import FormAdd from './_partials/FormAdd';

export default {

    mounted(){
        this.loadUsers()
        this.loadForms()
    },

    data() {
        return {
            clear: false,
            loading: false
        }
    },

    components: {
        Table,
        FormAdd
    },

    computed: {
        ...mapState({
            active_button_add_form: state => state.forms.active_button_add_form,
            forms: state => state.forms.forms,
            users: state => state.users.users,
        }),
    },

    methods: {
        ...mapActions([
            'getUsers',
            'saveForm',
            'getForms'
        ]),

        loadUsers(){
            this.loading = true;
            this.getUsers()
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar usuários!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        loadForms(){
            this.loading = true;
            this.getForms()
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar formulários!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        addForm(){
            let formData = new FormData(document.getElementById("form-add"));

            this.$swal.fire({
                title: '',
                text: "Realmente Deseja Executar esta ação?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, registrar formulário!',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#38c172',
                cancelButtonColor: '#6c757d',
            }).then((result) => {

                if (result.value) {
                    this.saveForm(formData)
                    .then(response => {

                        var result = response.data.result;

                        if (result >= 60) {
                            this.$swal.fire(
                                'Resultado:',
                                'Possível Infectado!',
                                'error',
                            ).then((result) => {
                               this.close()
                            })
                        } else if (result >= 40 && result < 60){
                            this.$swal.fire(
                                'Resultado:',
                                'Potencial Infectado!',
                                'warning',
                            ).then((result) => {
                                this.close()
                            })
                        } else if (result < 40){
                            this.$swal.fire(
                                'Resultado:',
                                'Sintomas Insuficientes!',
                                'success',
                            ).then((result) => {
                                this.close()
                            })
                        }

                    })
                    .catch((error) => {
                        Vue.$toast.open({ message: 'Erro ao registrar formulário!', type: 'error',  position: 'top-right'});
                    })
                    .finally(() => {
                        this.clear = false
                    });
                }
            })

        },

        close(){
            this.clear = true
            this.loadUsers()
            this.loadForms()
            $('.btn-close').click();
            Vue.$toast.open({ message: 'Formulário de consulta, registrado com sucesso!', type: 'success',  position: 'top-right'});
        }
    },
    
}
</script>