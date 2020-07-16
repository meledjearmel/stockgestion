const appLogin = new Vue ({
    el: '#app-login',
    data: {
        email: '',
        loading: false,
    },
    methods: {
        load: function () {

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
            let fields = document.querySelectorAll('.form-control');

            setTimeout(()=>{
                fields.forEach((field) => {
                    if (field.classList.contains('parsley-error')) {
                        this.loading = false
                        sending.innerHTML = 'Se connecter'
                    }
                })
            }, 700)
        }
    }
})
