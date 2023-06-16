<template>
    <div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
                    <th v-if="visualizar.visivel || editar.visivel || deletar.visivel || finalizar.visivel">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'texto'">{{ valor }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{ $filters.formataDataTempo(valor) }}
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'dinheiro'">
                            {{ $filters.formataDinheiro(valor) }}
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'array'">{{ valor.nome }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'attr'">{{ valor.placa }}</span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/' + valor" width="50" height="50">
                        </span>
                        <span v-else-if="titulos[chaveValor].tipo == 'status'">{{ valor.status }}</span>
                    </td>
                    <td v-if="visualizar.visivel || editar.visivel || deletar.visivel || finalizar.visivel">
                        <button v-if="visualizar.visivel" class="btn btn btn-primary btn-sm m-1" title="Visualizar dados"
                            :data-bs-toggle="visualizar.dataToggle" :data-bs-target="visualizar.dataTarget"
                            @click="setStore(obj, dados)"><i class="bi bi-eye"></i></button>
                        <button v-if="editar.visivel" class="btn btn btn-warning btn-sm m-1" title="Editar"
                            @click="setStore(obj, dados)" :data-bs-toggle="editar.dataToggle"
                            :data-bs-target="editar.dataTarget"><i class="bi bi-pencil"></i></button>
                        <button v-if="deletar.visivel" class="btn btn btn-danger btn-sm m-1" title="Deletar"
                            @click="setStore(obj, dados)" :data-bs-toggle="deletar.dataToggle"
                            :data-bs-target="deletar.dataTarget"><i class="bi bi-trash"></i></button>
                        <button v-if="finalizar.visivel" class="btn btn btn-success btn-sm m-1" title="Finalizar"
                            @click="setStore(obj, dados)" :data-bs-toggle="finalizar.dataToggle"
                            :data-bs-target="finalizar.dataTarget"><i class="bi bi-check-square-fill"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['dados', 'titulos', 'visualizar', 'editar', 'deletar', 'finalizar'],
    methods: {
        setStore(obj, dados) {
            let idObjeto = obj.id
            // fazer um foreach em dados
            dados.forEach((chave, valor) => {
                if (chave.id == idObjeto) {
                    let data = chave
                    this.$store.state.item = data
                }
            })
        },
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
