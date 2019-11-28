Vue.component('keuze', {
    template: 
        '<img class="logo" @click="redirect()" :src="bestand" :alt="naam">'
    ,
    props: {
        naam: String,
        bestandnaam: String
    },
    computed: {
        bestand: function(){
            return 'assets/' + this.bestandnaam;
        }
    },
    methods: {
        redirect: function(){
            window.location = this.naam;
        }
    }
})
new Vue({
    el: '#app'
})