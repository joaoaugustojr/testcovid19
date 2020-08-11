<template>
    <div class="row" :validate-check="validate">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-user"></i>
                    </span>
                </div>
                <input type="text" name="name" v-model="name" placeholder="Nome Completo*" title="Nome Completo" class="form-control uppercase" required>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-address-card"></i>
                    </span>
                </div>
                <input type="text" name="cpf" v-model="cpf" v-on:focusout="validCPFForm" placeholder="CPF*" title="CPF" :class="['form-control', 'cpf', cpfValid ? '' : 'is-invalid']" required>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fas fa-address-card"></i>
                    </span>
                </div>
                <input type="number" name="age" min="1" step="1" v-model="age" v-on:focusout="validAgeForm" placeholder="Idade*" title="Idade" class="form-control" required>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="icon fab fa-whatsapp"></i>
                    </span>
                </div>
                <input type="text" name="whatsapp_number" v-model="number" v-on:focusout="validNumberForm" placeholder="Whastapp" title="Número do Whastapp" :class="['form-control', 'phone-cel', numberValid ? '' : 'is-invalid']">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card mb-3">
                <div class="card-header d-flex">
                    <div class="input-group">
                        <label for="exampleFormControlFile1"><i class="fas fa-image"></i> Escolher Foto 3x4:</label>
                        <input type="file" name="photo" class="form-control-file" title="Foto do Membro" accept="image/png, image/jpeg" multiple>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapMutations, mapActions } from 'vuex';

export default {

    props: ['clear'],

    data() {
        return {
            cpf: '',
            name: '',
            age: '',
            number: '',
            photo: '',
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
            return false
        },
    },

    watch: {
        clear(){
            if (this.clear) {
                this.cpf = '',
                this.name = '',
                this.age = '',
                this.number = '',
                this.cpfValid = true,
                this.numberValid = true,
                $('input[type=file]').val('')
            }
        },
    },

    methods: {

        ...mapMutations({
            activeButtonAdd: 'ACTIVE_BUTTON_ADD',
        }),

        activeButton(active){
            this.activeButtonAdd(active)
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