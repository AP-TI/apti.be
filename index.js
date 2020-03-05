Vue.component('keuze', {
    template: 
        '<img class="logo" @click="redirect()" :src="bestand" :alt="naam">'
    ,
    props: {
        naam: String,
        bestandnaam: String,
        link: String
    },
    computed: {
        bestand: function(){
            return 'assets/' + this.bestandnaam;
        }
    },
    methods: {
        redirect: function(){
            window.location = this.link;
        }
    }
})
new Vue({
    el: '#app'
})