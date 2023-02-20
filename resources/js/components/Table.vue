<template>
    <div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th v-for="t, key in titulos" :key="key">{{t.titulo}}</th>
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
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos'],
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
