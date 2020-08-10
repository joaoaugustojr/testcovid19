<template>
    <div class="row" :validate-check="validate">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-user"></i>
                    </span>
                </div>
                <input type="text" name="name" v-model="name" placeholder="Nome Completo*" title="Nome Completo" class="form-control uppercase" required :disabled="view">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-address-card"></i>
                    </span>
                </div>
                <input type="text" name="cpf" v-model="cpf" v-on:focusout="validCPFForm" placeholder="CPF*" title="CPF" :class="['form-control', 'cpf', cpfValid ? '' : 'is-invalid']" required :disabled="view">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-address-card"></i>
                    </span>
                </div>
                <input type="number" name="age" min="1" step="1" v-model="age" v-on:focusout="validAgeForm" placeholder="Idade*" title="Idade" class="form-control" required :disabled="view">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fab fa-whatsapp"></i>
                    </span>
                </div>
                <input type="text" name="whatsapp_number" v-model="number" v-on:focusout="validNumberForm" placeholder="Whastapp" title="Número do Whastapp" :class="['form-control', 'phone-cel', numberValid ? '' : 'is-invalid']" :disabled="view">
            </div>
        </div>
    </div>
</template>

<script>

import { mapMutations } from 'vuex';

export default {

    mounted(){
        this.fillFields()
    },

    props: ['user', 'view'],

    data() {
        return {
            cpf: '',
            name: '',
            age: '',
            number: '',
            cpfValid: true,
            numberValid: true
        }
    },

    computed: {
        validate(){
            if(this.name == '' || this.cpf == '' || this.age == '' || !this.cpfValid || !this.numberValid){
                this.activeButton(true)
                return true
            }
            this.activeButton(false)
            return(false)
        },
    },

    methods: {

        ...mapMutations({
            activeButtonEdit: 'ACTIVE_BUTTON_EDIT',
        }),

        activeButton(active){
            this.activeButtonEdit(active)
        },

        fillFields(){
            if (this.user != '') {
                this.cpf = this.user.cpf
                this.name = this.user.name
                this.age = this.user.age
                this.number = this.user.whatsapp_number
            }
        },

        validCPFForm(){
            this.cpfValid = this.$validCPF(this.cpf)
        },

        validAgeForm() {
            this.age =  this.$validAge(this.age)
        },

        validNumberForm() {
            this.numberValid = this.$validNumber(this.number)
        }
    },
    
}

</script>