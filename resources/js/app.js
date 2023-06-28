/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import { createStore } from 'vuex';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
const store = createStore({ 
    state: { 
        item: {}
    } 
});

app.use(store)

// importar componentes globais
import Login from './components/Login.vue';
import Home from './components/Home.vue';
import InputContainer from './components/InputContainer.vue';
import Table from './components/Table.vue';
import Card from './components/Card.vue';
import Modal from './components/Modal.vue';
import Alert from './components/Alert.vue';
import Pagination from './components/Pagination.vue';
// ------ Views ------- //
import MarcaIndex from './components/Marcas/MarcaIndex.vue';
import ModeloIndex from './components/Modelos/ModeloIndex.vue';
import CarroIndex from './components/Carros/CarroIndex.vue';
import ClienteIndex from './components/Clientes/ClienteIndex.vue';
import LocacoesIndex from './components/Locacoes/LocacoesIndex.vue';

// servir componentes globais
app.component('login-component', Login);
app.component('home-component', Home);
app.component('input-container-component', InputContainer);
app.component('table-component', Table);
app.component('card-component', Card);
app.component('modal-component', Modal);
app.component('alert-component', Alert);
app.component('pagination-component', Pagination);
// ------ Views ------- //
app.component('marcaindex-component', MarcaIndex);
app.component('modeloindex-component', ModeloIndex);
app.component('carroindex-component', CarroIndex);
app.component('clienteindex-component', ClienteIndex);
app.component('locacoesindex-component', LocacoesIndex);

// filtro de formatação de data global
app.config.globalProperties.$filters = {
    formataDataTempo(d) {
        if (!d) return "";
        
        d = d.split("T")
        let data = d[0]
        data = data.split("-")
        data = data[2] + "/" + data[1] + "/" + data[0];
    
        let tempo = d[1]  
        tempo = tempo.split('.')
        tempo = tempo[0]     
    
        return tempo + ' - ' + data
    },
    formataDinheiro(d) {
        if (!d) return "";
        
        let valor =  d.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })
        return valor
    },
    formataDataptbr(d) {
        if (!d) return "";

        let d1 = new Date(d);
        let dataPTBR = d1.toLocaleDateString("pt-BR");
        return dataPTBR
    }
},
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
*/

app.mount('#app');
