const appLogin = new Vue ({
    el: '#app-selling',
    data: {
        product: {
            code: '',
            name: '',
            price: 500,
            count: 1,
        },
        clientMount: '',
        productCount: 0,
        facture: {},
    },
    methods: {
        calcMonnaie: function () {
            const mountHTML = document.querySelector('#monnaie')
            let mount = this.clientMount - this.calculMount()
            if (mount < 0) {
                if (this.clientMount === ''){
                    mountHTML.value = 'Veuillez entrer donné par le client'
                    return
                }
                mountHTML.value = ''
                return
            }
            mountHTML.value = 'La monnaie est de ' + mount + ' XOF'
        },
        calculMount: function () {
            let price = parseInt(this.product.price)
            let count = parseInt(this.product.count)
            let mount = price * count
            for (let i in this.facture) {
                let product = this.facture[i]
                mount += product.price * product.count
            }
            const mountHTML = document.querySelector('#mountDash')
            mountHTML.innerText = mount + ' XOF'
            return mount
        },
        delRecentProduct: function () {

        },
        resetFact: function () {
            this.facture = {}
        },
        printFact: function () {
            const modal = document.querySelector('#factureModal #facturePrint')
            let WinPrint = window.open('', '', 'left=0, top=0, toolbar=0, scrollbars=0, status=0, width=387px, height='+modal.clientHeight+'px, font-size=8px !important');
            WinPrint.document.write(modal.innerHTML)
            WinPrint.document.close()
            WinPrint.focus()
            WinPrint.print()
            WinPrint.close()
            this.facture = {};
            this.product.code = ''
            this.product.name = ''
            this.product.price = 500
            this.product.count = 1
            this.productCount = 0
        },
        addProduct: function () {
            if (this.product.name !== '' && this.product.code.length === 8)
            {
                product = new Object({
                    code: this.product.code,
                    name: this.product.name,
                    price: this.product.price,
                    count: this.product.count,
                })
                this.facture[this.productCount] = product
                this.productCount++
                this.product.code = ''
                this.product.name = ''
                this.product.price = 500
                this.product.count = 1
            }
        },
        doFacture: function () {
            this.addProduct()
            const modal = document.querySelector('#factureModal #factContent')
            const mountHTML = document.querySelector('#factureModal #mount')
            let table = ''
            let result = ''
            let mount = 0
            for (let i in this.facture) {
                let product = this.facture[i]
                let a = parseInt(i)
                let id = a + 1
                table += '<tr><th scope="row">'+ id +'</th><td>'+product.name+'</td> <td>'+product.price+' XOF</td> <td>'+product.count+'</td><td>'+product.count*product.price+' XOF</td></tr>'
            }

            for (let i in this.facture) {
                let product = this.facture[i]
                mount += product.price*product.count
                result = '<tr><th scope="row" colspan="4">TOTAL</th><td>'+mount+' XOF</td></tr>'
            }

            modal.innerHTML = table + result
            mountHTML.innerText = mount + ' XOF'
        }
    }
})
