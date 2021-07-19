let ArticleSelect = {
    data: function () {
        return {

        }
    },
    props: ['articles'],
    template: `<select id="article_id" name="article_id" class="form-control article-list-items select2-show-search">
                    <option v-for="article in articles" :value="article.id">{{ article.name }} ( {{ article.value }} produit(s) restant(s) )</option>
               </select>`,

    methods : {

    },
}

let appLogin = new Vue ({
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

    components: {
        ArticleSelect
    },

    methods: {
        sendWarehouseId: function () {
            axios.get('/sellpoint/json/' + this.warehouse_id)
            .then((res)=>{
                this.state.articles = res.data
                let items = $('.article-list-items').select2();
                items.select2('destroy')
                items.select2()
                if (this.state.articles.length) {
                    this.state.wareUsed = true
                    this.state.placeholder = 'Choisissez un article'
                } else {
                    this.state.wareUsed = false
                    this.state.placeholder = 'Choisissez d\'abord un entrepot non vide'
                }

            })
            .catch((err)=>{console.log(err)})
        },
    },

    directives: {
        select : {
            twoWay: true,
            bind: function (el, binding, vnode) {
                $(el).select2().on("select2:select", (e) => {
                    el.dispatchEvent(new Event('change',{ target: e.target }));
                });
            },
        }
    }

})
