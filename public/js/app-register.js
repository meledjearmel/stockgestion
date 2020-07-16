const appRegister = new Vue ({
    el: '#app-register',
    data: {
        /* Data rescue */
        agree: true,
        loading: false,
        firstname: 'Armel',
        lastname: 'Meledje',
        email: 'meledjearmel@gmail.com',
        password: '06743632',
        passConfirm: '06743632',

        /* Validate data */
        vF: true,
        vL: true,
        vE: true,
        vP: true,
        vPC: true,
    },
    methods: {
        validFirstname: function () {

            let field = document.querySelector('#firstname');

            let f = this.firstname;

            let nameReg = RegExp('^[a-z ]+', 'gi')

            if (f !== '') {

                if (f == f.match(nameReg)) {
                    if (field.classList.contains('parsley-error')){
                        field.classList.remove('parsley-error')
                    }
                    field.classList.add('parsley-success')
                    this.vF = true
                } else {
                    if (field.classList.contains('parsley-sucsess')){
                        field.classList.remove('parsley-success')
                    }
                    field.classList.add('parsley-error')
                    this.vF = false
                }
            } else {
                if (field.classList.contains('parsley-sucsess')){
                    field.classList.remove('parsley-success')
                }
                field.classList.add('parsley-error')
                this.vF = false
            }

        },

        validLastname: function () {

            let field = document.querySelector('#lastname')

            let f = this.lastname

            let nameReg = RegExp('^[a-z ]+', 'gi');

            if (f !== '') {
                if (f == f.match(nameReg)) {
                    if (field.classList.contains('parsley-error')){
                        field.classList.remove('parsley-error')
                    }
                    field.classList.add('parsley-success')
                    this.vL = true
                } else {
                    if (field.classList.contains('parsley-sucsess')){
                        field.classList.remove('parsley-success')
                    }
                    field.classList.add('parsley-error')
                    this.vL = false
                }
            } else {
                if (field.classList.contains('parsley-sucsess')){
                    field.classList.remove('parsley-success')
                }
                field.classList.add('parsley-error')
                this.vL = false
            }

        },

        validEmail: function () {

            let field = document.querySelector('#email')

            let f = this.email

            let emailReg = RegExp('^[a-z][a-z0-9]+@[a-z]+\.[a-z]+', 'gi')

            if (f !== '') {
                if (f == f.match(emailReg)) {
                    if (field.classList.contains('parsley-error')){
                        field.classList.remove('parsley-error')
                    }
                    field.classList.add('parsley-success')
                    this.vE = true
                } else {
                    if (field.classList.contains('parsley-sucsess')){
                        field.classList.remove('parsley-success')
                    }
                    field.classList.add('parsley-error')
                    this.vE = false
                }
            } else {
                if (field.classList.contains('parsley-sucsess')){
                    field.classList.remove('parsley-success')
                }
                field.classList.add('parsley-error')
                this.vE = false
            }

        },

        validPass: function () {

            let field = document.querySelector('#password');

            if (this.password !== '') {
                if (this.password.length >= 8) {
                    if (field.classList.contains('parsley-error')) {
                        field.classList.remove('parsley-error')
                    }
                    field.classList.add('parsley-success')
                    this.vP = true
                } else {
                    if (field.classList.contains('parsley-sucsess')) {
                        field.classList.remove('parsley-success')
                    }
                    field.classList.add('parsley-error')
                    this.vP = false
                }
            } else {
                if (field.classList.contains('parsley-sucsess')) {
                    field.classList.remove('parsley-success')
                }
                field.classList.add('parsley-error')
                this.vP =false
            }

            if(this.passConfirm !== '') {
                this.validPassConf()
            }

        },

        validPassConf: function () {

            let field = document.querySelector('#passConfirm');

            if (this.passConfirm !== '') {
                if (this.password === this.passConfirm) {
                    if (field.classList.contains('parsley-error')) {
                        field.classList.remove('parsley-error')
                    }
                    field.classList.add('parsley-success')
                    this.vPC = true
                } else {
                    if (field.classList.contains('parsley-sucsess')) {
                        field.classList.remove('parsley-success')
                    }
                    field.classList.add('parsley-error')
                    this.vPC = false
                }
            } else {
                if (field.classList.contains('parsley-sucsess')) {
                    field.classList.remove('parsley-success')
                }
                field.classList.add('parsley-error')
                this.vPC = false
            }
        },

        isValid: function () {
            if (this.vF && this.vL && this.vE && this.vP && this.vPC && this.agree) {
                let form = document.querySelector('#formRegister');
                form.submit();
            } else {

            }

            let fields = document.querySelectorAll('.form-control');

            fields.forEach((field) => {
                let sending = document.querySelector('#submit')
                if (field.classList.contains('parsley-error')) {
                    this.loading = false
                    sending.innerHTML = 'Se connecter'
                }
            })

        },

        spinner: function () {
            this.loading = true
            let sending = document.querySelector('#send')
            sending.innerHTML =
                `<div class="sk-wave" style="margin: 0 auto !important;">
                <div class="sk-rect sk-rect1" style="background: #fff"></div>
                <div class="sk-rect sk-rect2" style="background: #fff"></div>
                <div class="sk-rect sk-rect3" style="background: #fff"></div>
                <div class="sk-rect sk-rect4" style="background: #fff"></div>
                <div class="sk-rect sk-rect5" style="background: #fff"></div>
                </div>`;

            setTimeout(()=>{
                this.isValid()
            }, 700)
        }
    }
})
