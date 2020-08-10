export default {

    methods: {

        $validCPF(cpf) {
            var inputCPF = cpf.replace(/[^\d]+/g, '');
            var soma = 0,
                i, resto;

            if (inputCPF == '' ||
                inputCPF == "00000000000" ||
                inputCPF == "11111111111" ||
                inputCPF == "22222222222" ||
                inputCPF == "33333333333" ||
                inputCPF == "44444444444" ||
                inputCPF == "55555555555" ||
                inputCPF == "66666666666" ||
                inputCPF == "77777777777" ||
                inputCPF == "88888888888" ||
                inputCPF == "99999999999" ||
                inputCPF.length != 11
            ) {
                Vue.$toast.open({
                    message: 'CPF Inválido',
                    type: 'error',
                    position: 'top-right'
                });
                return false;
            }

            for (i = 1; i <= 9; i++) {
                soma = soma + parseInt(inputCPF.substring(i - 1, i)) * (11 - i);
            }

            resto = (soma * 10) % 11;

            if (resto == 10 || resto == 11) {
                resto = 0;
            }

            if (resto != parseInt(inputCPF.substring(9, 10))) {
                Vue.$toast.open({
                    message: 'CPF Inválido',
                    type: 'error',
                    position: 'top-right'
                });
                return false;
            }

            soma = 0;

            for (i = 1; i <= 10; i++) {
                soma = soma + parseInt(inputCPF.substring(i - 1, i)) * (12 - i);
            }

            resto = (soma * 10) % 11;

            if (resto == 10 || resto == 11) {
                resto = 0;
            }

            if (resto != parseInt(inputCPF.substring(10, 11))) {
                Vue.$toast.open({
                    message: 'CPF Inválido',
                    type: 'error',
                    position: 'top-right'
                });
                return false;
            }

            return true;
        },

        $validAge(age) {
            if (age > 125) {
                age = 125
            }
            return age
        },

        $validNumber(number) {
            if (number != '' && number.length != 15) {
                Vue.$toast.open({
                    message: 'Número de Whatsapp Inválido',
                    type: 'error',
                    position: 'top-right'
                });
                return false
            }
            return true
        }

    },

};