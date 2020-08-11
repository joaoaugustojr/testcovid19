<template>
    <div class="row" :validate="validate">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="alert alert-info" role="alert">
                1º Selecione o usuário: {{ user_name }}
            </div>
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 col-12">
            <label>Id</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-id-card-alt"></i>
                    </span>
                </div>
                <input type="number" v-model="user_selected" @change="selectedUserChange()" name="id" min="1" step="1" title="Id do Usuário" class="form-control">
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <label for="basic-url">Nome do Usuário</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-user"></i>
                    </span>
                </div>
                <select name="name" v-model="user_selected" @change="selectedUserChange()" class="custom-select form-control input-tab" id="tab1" title="Nome do Membro">
                    <option v-if="loading" value="">Carregando</option>
                    <option value=""></option>
                    <option v-for="(user, index) in users.data" :key="index" :value="user.id" >{{ user.name }}</option>
                </select>
            </div>
        </div>
        <span v-if="user_name && user_selected" class="w-100">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="alert alert-info" role="alert">
                    2º Marque 'Sim' para os sintomas apresentados!
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Febre?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="fever1" name="fever" :value="0" v-model="fever" class="custom-control-input">
                            <label class="custom-control-label" for="fever1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="fever2" name="fever" :value="1" v-model="fever" class="custom-control-input">
                            <label class="custom-control-label" for="fever2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Coriza?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="coryza1" name="coryza" :value="0" v-model="coryza" class="custom-control-input">
                            <label class="custom-control-label" for="coryza1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="coryza2" name="coryza" :value="1" v-model="coryza" class="custom-control-input">
                            <label class="custom-control-label" for="coryza2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Nariz Entupido?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="stuffy_nose1" name="stuffy_nose" :value="0" v-model="stuffy_nose" class="custom-control-input">
                            <label class="custom-control-label" for="stuffy_nose1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="stuffy_nose2" name="stuffy_nose" :value="1" v-model="stuffy_nose" class="custom-control-input">
                            <label class="custom-control-label" for="stuffy_nose2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Cansaço?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="tiredness1" name="tiredness" :value="0" v-model="tiredness" class="custom-control-input">
                            <label class="custom-control-label" for="tiredness1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="tiredness2" name="tiredness" :value="1" v-model="tiredness" class="custom-control-input">
                            <label class="custom-control-label" for="tiredness2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Tosse?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="cough1" name="cough" :value="0" v-model="cough" class="custom-control-input">
                            <label class="custom-control-label" for="cough1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="cough2" name="cough" :value="1" v-model="cough" class="custom-control-input">
                            <label class="custom-control-label" for="cough2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Dor de Cabeça?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="headache1" name="headache" :value="0" v-model="headache" class="custom-control-input">
                            <label class="custom-control-label" for="headache1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="headache2" name="headache" :value="1" v-model="headache" class="custom-control-input">
                            <label class="custom-control-label" for="headache2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Dores no Corpo?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="body_aches1" name="body_aches" :value="0" v-model="body_aches" class="custom-control-input">
                            <label class="custom-control-label" for="body_aches1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="body_aches2" name="body_aches" :value="1" v-model="body_aches" class="custom-control-input">
                            <label class="custom-control-label" for="body_aches2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Mal estar em geral?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="general_discomfort1" name="general_discomfort" :value="0" v-model="general_discomfort" class="custom-control-input">
                            <label class="custom-control-label" for="general_discomfort1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="general_discomfort2" name="general_discomfort" :value="1" v-model="general_discomfort" class="custom-control-input">
                            <label class="custom-control-label" for="general_discomfort2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Dor de garganta?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="sore_throat1" name="sore_throat" :value="0" v-model="sore_throat" class="custom-control-input">
                            <label class="custom-control-label" for="sore_throat1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="sore_throat2" name="sore_throat" :value="1" v-model="sore_throat" class="custom-control-input">
                            <label class="custom-control-label" for="sore_throat2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Dificuldade de respirar?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="dyspnea1" name="dyspnea" :value="0" v-model="dyspnea" class="custom-control-input">
                            <label class="custom-control-label" for="dyspnea1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="dyspnea2" name="dyspnea" :value="1" v-model="dyspnea" class="custom-control-input">
                            <label class="custom-control-label" for="dyspnea2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Falta de paladar?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="lack_of_taste1" name="lack_of_taste" :value="0" v-model="lack_of_taste" class="custom-control-input">
                            <label class="custom-control-label" for="lack_of_taste1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="lack_of_taste2" name="lack_of_taste" :value="1" v-model="lack_of_taste" class="custom-control-input">
                            <label class="custom-control-label" for="lack_of_taste2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Falta de olfato?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="loss_of_smell1" name="loss_of_smell" :value="0" v-model="loss_of_smell" class="custom-control-input">
                            <label class="custom-control-label" for="loss_of_smell1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="loss_of_smell2" name="loss_of_smell" :value="1" v-model="loss_of_smell" class="custom-control-input">
                            <label class="custom-control-label" for="loss_of_smell2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Dificuldade de locomoção?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="locomotion_difficulty1" name="locomotion_difficulty" :value="0" v-model="locomotion_difficulty" class="custom-control-input">
                            <label class="custom-control-label" for="locomotion_difficulty1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="locomotion_difficulty2" name="locomotion_difficulty" :value="1" v-model="locomotion_difficulty" class="custom-control-input">
                            <label class="custom-control-label" for="locomotion_difficulty2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="input-group mb-3 justify-content-between">
                    <label class="mr-3"><i class="icon fas fa-briefcase-medical mr-1 text-success"></i><b>Diarreia?</b></label>
                    <span>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="diarrhea1" name="diarrhea" :value="0" v-model="diarrhea" class="custom-control-input">
                            <label class="custom-control-label" for="diarrhea1">Sim</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="diarrhea2" name="diarrhea" :value="1" v-model="diarrhea" class="custom-control-input">
                            <label class="custom-control-label" for="diarrhea2">Não</label>
                        </div>
                    </span>
                </div>
            </div>
        </span>
    </div>
</template>

<script>

import { mapMutations } from 'vuex';

export default {

    props: ['users', 'loading', 'clear'],

    data(){
        return {
            user_selected: '',
            user_name: '',
            fever: 1, // Febre
            coryza: 1, // Coriza
            stuffy_nose: 1, // Nariz Entupido
            tiredness: 1, // Cansaço
            cough: 1, // Tosse
            headache: 1, // Dor de Cabeça
            body_aches: 1, // Dores no Corpo
            general_discomfort: 1, // Mal Estar Geral
            sore_throat: 1, // Dor de Garganta
            dyspnea: 1, // Dificuldade de Respirar
            lack_of_taste: 1, // Falta de Paladar
            loss_of_smell: 1, // Falta de Olfato
            locomotion_difficulty: 1, // Dificuldade de Locomoção
            diarrhea: 1, // Diarreia
        }
    },

    computed: {
        validate(){
            if(this.user_selected == '' || this.user_name == ''){
                this.activeButton(true)
                return true
            }
            this.activeButton(false)
            return false
        },
    },

    watch: {
        clear(){
            if (this.clear) {
                this.user_selected = '';
                this.user_name = '';
                this.fever = 1; 
                this.coryza = 1; 
                this.stuffy_nose = 1; 
                this.tiredness = 1;
                this.cough = 1;
                this.headache = 1
                this.body_aches = 1;
                this.general_discomfort = 1;
                this.sore_throat = 1;
                this.dyspnea = 1;
                this.lack_of_taste = 1;
                this.loss_of_smell = 1;
                this.locomotion_difficulty = 1;
                this.diarrhea = 1;
            }
        }
    },

    methods:{

        ...mapMutations({
            activeButtonAddForm: 'ACTIVE_BUTTON_ADD_FORM',
        }),

        activeButton(active){
            this.activeButtonAddForm(active)
        },

        selectedUserChange(){
            if (this.users.data.length > 0) {

                let id = this.user_selected;

                const member = this.users.data.find(function (element)  { 
                    return element.id == id; 
                }); 

                if (member !== undefined) {
                    this.user_name = member.name
                } else {
                    this.user_name = ''
                }
                
            } else {
                this.user_name = ''
            }
        },
    }

}
</script>