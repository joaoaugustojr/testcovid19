<template>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="datatables-style" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" data-priority="1">ID</th>
                    <th scope="col" data-priority="2">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Whatsapp</th>
                    <th scope="col">Data Registro</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                 <tr v-for="(record, index) in users.data" :key="index">
                    <td scope="row">{{record.id}}</td>
                    <td>{{record.name}}</td>
                    <td nowrap>{{record.cpf}}</td>
                    <td>{{record.age}}</td>
                    <td>{{record.whatsapp_number}}</td>
                    <td>{{record.created_at}}</td>
                    <td nowrap>
                        <a class="btn btn-primary btn-sm" href="#" v-on:click="loadUser(record.id, false)" role="button" title="Editar Usuário" alt="Editar Usuário" data-toggle="modal" data-target="#modal-edit-view"><i class="icon fas fa-pen"></i></a>
                        <a class="btn btn-secondary btn-sm" href="#" v-on:click="loadUser(record.id, true)" role="button" title="Visualizar Usuário" alt="Visualizar Usuário" data-toggle="modal" data-target="#modal-edit-view"><i class="icon fas fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" v-on:click="removeElement(record.id)" role="button" title="Remover Usuário" alt="Remover Usuário"><i class="icon fas fa-trash"></i></a>
                        <a v-if="record.whatsapp_number" class="btn btn-success btn-sm" :href="getUrlWhats(record.whatsapp_number)" target="_blank" role="button" title="Enviar Mensagem" alt="Enviar Mensagem"><i class="icon fab fa-whatsapp"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="modal-edit-view" tabindex="-1" role="dialog" aria-labelledby="modal-edit-view" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">
                            <i v-if="view" class="icon mr-2 fas fa-eye"></i>
                            <i v-else class="icon mr-2 fas fa-user-edit"></i>
                            <span v-if="loading">Carregando...</span>
                            <span v-else>Editar Usuário: {{user.name}}</span>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form v-if="!loading" id="form-edit" v-on:submit.prevent="alterUser()" method="POST">
                        <div class="modal-body">
                            <Form :user="user" :view="view"></Form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" :disabled="active_button_edit"><i class="icon fas fa-save"></i> Salvar</button>
                            <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Sair</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapActions, mapState, mapGetters} from 'vuex';
import Form from './Form';

export default {

    props: ['users'],

    data() {
        return {
            id: '',
            loading: false,
            view: false
        }
    },

    components: {
        Form
    },

    computed: {
        ...mapState({
            active_button_edit: state => state.users.active_button_edit,
            user: state => state.users.user,
        }),
    },

    methods: {

        ...mapActions([
            'getUser',
            'editUser',
            'getUsers',
            'removeUser'
        ]),

        loadUser(id, view){
            this.loading = true;
            this.view = view;

            this.getUser(id)
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao garregar usuário!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {
                this.loading = false;
                this.id = id;
            })
        },

        loadUsers(){
            this.loading = true;
            this.getUsers()
            .catch((error) => {
                Vue.$toast.open({ message: 'Erro ao listar usuários!', type: 'error',  position: 'top-right'})
            })
            .finally(() => {this.loading = false});
        },

        alterUser(){
            let formData = new FormData(document.getElementById("form-edit"));
            formData.append('_method', 'PATCH');
            let id = this.id

            this.editUser({formData, id})
                .then(response => {
                    $('.btn-close').click(); 
                    Vue.$toast.open({ message: 'Usuário editado com sucesso!', type: 'success',  position: 'top-right'});
                    this.loadUsers()
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        var erros = error.response.data.errors
                        for (const item in erros) {
                            Vue.$toast.open({ message: erros[item][0], type: 'error',  position: 'top-right'})
                        }
                    } else {
                        Vue.$toast.open({ message: 'Erro ao editar usuário!', type: 'error',  position: 'top-right'})
                    }
                })
                .finally();
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
                    this.removeUser(id)
                        .then(response => {
                            Vue.$toast.open({ message: 'Usuário removido com sucesso!', type: 'success',  position: 'top-right'});
                            this.loadUsers()
                        })
                        .catch(error => {
                            Vue.$toast.open({ message: 'Erro ao remover usuário!', type: 'error',  position: 'top-right'})
                            this.loadUsers()
                        })
                }
            })
        },

        getUrlWhats(number){
            var number = number.replace(/[^\d]+/g,'');
            var url = `https://api.whatsapp.com/send?phone=55${number}&text=Ol%C3%A1!%20Tudo%20bem%3F`
            return url
        }

    }

}
</script>