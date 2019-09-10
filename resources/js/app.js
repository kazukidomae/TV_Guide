require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const program = new Vue({
    el: '#program-list',
    data: {
        programs: [],
        historys: [],
        keyword: ''
    },
    methods:{
        programlist(){
            axios.get('/api/list').then((res)=>{
                this.programs = res.data
            })
        },
        search(){
            axios.post('/api/search',{
                keyword:this.keyword
            }).then((res)=>{
                this.programs = res.data
                this.history()
            })
        },
        history(){
            axios.get('/api/history').then((res)=>{
                this.historys = res.data
            })
        },
        setkeyword(key){
            this.keyword = this.historys[key].keyword
        }
    },created() {
        this.programlist()
        this.history()
    },
});