<template>
    <div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th v-for="t, key in titulos" :key="key">{{t.titulo}}</th>
                    <th v-if="visualizar.visivel || editar.visivel || deletar.visivel">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{valor}}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{ '...'+valor}}
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor" width="50" height="50">
                        </span>
                    </td>
                    <td v-if="visualizar.visivel || editar.visivel || deletar.visivel"> 
                        <button v-if="visualizar.visivel" class="btn btn btn-primary btn-sm m-1" title="Visualizar" :data-bs-toggle="visualizar.dataToggle" :data-bs-target="visualizar.dataTarget" @click="setStore(obj)"><i class="bi bi-eye"></i></button>
                        <button v-if="editar.visivel" class="btn btn btn-warning btn-sm m-1" title="Editar" @click="setStore(obj)" :data-bs-toggle="editar.dataToggle" :data-bs-target="editar.dataTarget"><i class="bi bi-pencil"></i></button>
                        <button v-if="deletar.visivel" class="btn btn btn-danger btn-sm m-1" title="Deletar" @click="setStore(obj)" :data-bs-toggle="deletar.dataToggle" :data-bs-target="deletar.dataTarget"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos', 'visualizar', 'editar', 'deletar'],
        methods: {
            setStore(obj) {
                this.$store.state.item = obj
            }
        },
        computed: {
            // filtrar dados de acorda com os metadados recebidos no bind :titulos
            dadosFiltrados() {
                
                // resgata cada atributo da props "dados"
                let campos = Object.keys(this.titulos)
                // array a ser preenchido com cada objeto
                let dadosFiltrados = []

                // percorrar o array atribuido a props 'dados'
                this.dados.map((item, chave) => {

                    let itemFiltrado = {}
                    campos.forEach(campo => {
                        
                        itemFiltrado[campo] = item[campo] //utilizar a sintaxe de array para atribuir valores a objetos
                    })
                    dadosFiltrados.push(itemFiltrado)
                })

                return dadosFiltrados //retorne um array de objetos 
            }
        }
    }
</script>
