const appLogin = new Vue ({
    el: '#app-sellpoint-supply',
    data: {
        warehouse_id: 0,
        article_id: '',
        state: {
            articles: {},
            wareUsed: false,
            quantity: 0,
            placeholder: 'Choisissez d\'abord un entrepot non vide',
        },
    },

    methods: {
        sendWarehouseId: function () {
            axios.get('/sellpoint/json/' + this.warehouse_id)
            .then((res)=>{
                this.state.articles = res.data
                if (this.state.articles.length) {
                    this.state.wareUsed = true
                    this.state.placeholder = 'Choisissez un article'
                } else {
                    this.state.wareUsed = false
                    this.state.placeholder = 'Choisissez d\'abord un entrepot non vide'
                }

                let test = document.querySelector('#select2-article_id-container')
                console.log(test)

            })
            .catch((err)=>{console.log(err)})
        },
    },

    directives: {
        select : {
            twoWay: true,
            bind: function (el, binding, vnode) {
                $(el).select2().on("select2:select", (e) => {
                    // v-model looks for
                    //  - an event named "change"
                    //  - a value with property path "$event.target.value"
                    el.dispatchEvent(new Event('change',{ target: e.target }));
                });
            },
        }
    }

})
