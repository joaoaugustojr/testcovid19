<template>
    <div>

        <div class="button-group">
            <a class="btn btn-success mb-3" href="#" role="button" alt="adicionar usuário" title="Adicionar Usuário" data-toggle="modal" data-target="#modal-add-view"><i class="icon fas fa-plus"></i> Adicionar Novo Usuário </a>
            <a class="btn btn-secondary mb-3" href="forms" role="button" alt="preencher novo formulário" title="Preencher Novo Formulário"><i class="icon fas fa-th-list"></i> Preencher Novo Formulário</a>
        </div>
    
        <div id="accordion">
            <div class="card">
                <div class="card-header p-3" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h6 class="mb-0">
                        <i class="icon fas fa-th-list"></i>
                        Lista de Usuários
                    </h6>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" data-js="div">
                    <div v-if="users.data.length > 0 && !loading" class="card-body">
                        <Table :users="users"></Table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-add-view" tabindex="-1" role="dialog" aria-labelledby="modal-add-view" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">
                            <i class="icon mr-2 fas fa-user"></i>
                            <span>Adicionar Novo Usuário</span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-add" v-on:submit.prevent="addUser">
                        <div class="modal-body">
                            <FormAdd :clear="clear"></FormAdd>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" :disabled="active_button_add"><i class="icon fas fa-plus"></i> Adicionar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
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

    mounted() {
        this.loadUsers()
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
            active_button_add: state => state.users.active_button_add,
            users: state => state.users.users,
        }),
    },

    methods: {

        ...mapActions([
            'saveUser',
            'getUsers'
        ]),

        loadUsers(){
            this.loading = true;
            this.getUsers()
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar usuários!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        addUser(){
            let formData = new FormData(document.getElementById("form-add"));
            formData.append('photo', $('input[type=file]')[0].files[0]); 

            this.saveUser(formData)
                .then(response => {
                    this.clear = true
                    Vue.$toast.open({ message: 'Usuário cadastrado com sucesso!', type: 'success',  position: 'top-right'});
                    this.loadUsers()
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        var erros = error.response.data.errors
                        for (const item in erros) {
                            Vue.$toast.open({ message: erros[item][0], type: 'error',  position: 'top-right'})
                        }
                    } else {
                        Vue.$toast.open({ message: 'Erro ao cadastrar usuário!', type: 'error',  position: 'top-right'})
                    }
                })
                .finally(() => {
                    this.clear = false
                });

        }
    }
    
}

</script>