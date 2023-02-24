<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca de modelos -->
                <card-component titulo="Busca de Modelos">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                    texto-ajuda="(Opcional) Informe o ID do modelo">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                        placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome do Modelo" id="inputNome" id-help="nomeHelp"
                                    texto-ajuda="(Opcional) Informe o nome do Modelo">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp"
                                        placeholder="Ex: Gol">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left"
                            @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de modelos -->

                <!-- Card de Listagem de marca -->
                <card-component titulo="Relação de Modelos">
                    <template v-slot:conteudo>
                        <table-component
                        :dados="modelos.data"
                        :visualizar="{
                            visivel: true,
                            dataToggle: 'modal',
                            dataTarget: '#modalModeloVisualizar'
                        }" :editar="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalModeloEditar'
                        }" :deletar="{
                                dataToggle: 'modal',
                                dataTarget: '#modalModeloDeletar',
                                visivel: true
                        }" :titulos="{
                                id: { titulo: 'ID', tipo: 'texto' },
                                nome: { titulo: 'Nome', tipo: 'texto' },
                                marca: { titulo: 'Marca', tipo: 'texto' },
                        }"
                        >
                        </table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">

                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm adicionar" data-bs-toggle="modal"
                                    data-bs-target="#modalModelo">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- Fim do Card de Listagem de marca -->
            </div>
        </div>
        <!-- Modal de cadastro de marca -->
        <modal-component id="modalModelo" titulo="Cadastro de Modelo">
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Marca do modelo" id="marcaModelo" id-help="marcaModeloHelp"
                        texto-ajuda="(Obrigatório) Informe a marca que o modelo pertence">
                        <select class="form-select" aria-label="numeroPortas" v-model="marcaModelo">
                            <option v-for="item, key in marcas.data" :key="key" :value="item[0]">{{ item[1] }}</option>
                        </select>
                    </input-container-component>
                    <input-container-component titulo="Nome do Modelo" id="novoModelo" id-help="novoModeloHelp"
                        texto-ajuda="(Obrigatório) Informe o nome do modelo">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                            placeholder="Nome do modelo" v-model="novoModelo" required>
                    </input-container-component>
                    <input-container-component titulo="Número de Portas" id="numeroPortas" id-help="numeroPortasHelp"
                        texto-ajuda="(Obrigatório) Informe o Número de Portas">
                        <select class="form-select" aria-label="numeroPortas" v-model="numeroPortas">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">5</option>
                            <option value="3">6</option>
                        </select>
                    </input-container-component>
                    <input-container-component titulo="Lugares" id="lugaresModelo" id-help="lugaresHelp"
                        texto-ajuda="(Obrigatório) Informe a quantidade de Lugares">
                        <select class="form-select" aria-label="lugaresModelo" id="lugaresModelo" v-model="lugaresModelo">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="3">4</option>
                            <option value="3">5</option>
                            <option value="3">6</option>
                            <option value="3">7</option>
                        </select>
                    </input-container-component>
                    <input-container-component titulo="Air Bag" id="airbagModelo" id-help="airbagHelp"
                        texto-ajuda="(Obrigatório) Informe se o modelo possui Air Bag">
                        <select class="form-select" aria-label="airbagModelo" id="airbagModelo" v-model="airbagModelo">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </input-container-component>
                    <input-container-component titulo="ABS" id="absModelo" id-help="absHelp"
                        texto-ajuda="(Obrigatório) Informe se o modelo possui ABS">
                        <select class="form-select" aria-label="absModelo" id="absModelo" v-model="absModelo">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </input-container-component>
                    <input-container-component titulo="Imagem do Modelo" id="novaImagem" name="novaImagem"
                        id-help="imagemHelp" texto-ajuda="(Obrigatório) Selecione a imagem do modelo">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="imagemHelp"
                            @change="carregarImagem($event)" required>
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar Modelo</button>
            </template>
        </modal-component>
        <!-- Fim do modal de cadastro de marca -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            urlBase: 'http://127.0.0.1:8000/api/v1/modelo',
            urlPaginacao: '',
            urlFiltro: '',
            marcaModelo: '',
            novoModelo: '',
            numeroPortas: '',
            lugaresModelo: '',
            airbagModelo: '',
            absModelo: '',
            imagemModelo: [],
            feedbackStatus: '',
            feedbackMessage: [],
            modelos: {
                data: []
            },
            marcas: {
                data: []
            },
            busca: { id: '', nome: '', numero_portas: '', lugares: '', air_bag: '', abs: '' }
        }
    },
    methods: {
        // carregarModelos() {
        //     axios.get(this.urlBase)
        //         .then(response => {
        //             this.modelos = response.data
        //         })
        //         .catch(errors => {
        //             console.log(errors)
        //         })
        // },
        carregarDadosMarcas() {
            let urlMarca = 'http://127.0.0.1:8000/api/v1/marca'
            axios.get(urlMarca)
                .then(response => {
                    let marcasDados = response.data.data
                    marcasDados.forEach((valorAtual, indice, array) => {
                        var dadosMarca = [valorAtual.id, valorAtual.nome];
                        this.marcas.data.push(dadosMarca)
                    })
                    console.log(this.marcas)
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        carregarImagem(e) {
            this.imagemModelo = e.target.files
        },
        salvar() {
            console.log(this.marcaModelo, this.novoModelo, this.numeroPortas, this.lugaresModelo, this.airbagModelo, this.absModelo, this.imagemModelo[0])
            // instanciando um formulário para definir os atributos
            let formData = new FormData();
            formData.append('marca_id', this.marcaModelo);
            formData.append('nome', this.novoModelo);
            formData.append('imagem', this.imagemModelo[0]);
            formData.append('numero_portas', this.numeroPortas);
            formData.append('lugares', this.lugaresModelo);
            formData.append('air_bag', this.airbagModelo);
            formData.append('abs', this.absModelo);

            // cabeçalhos da requisição
            let cfg = {
                headres: {
                    'Content-Type': 'multipart/form-data',
                }
            }

            // enviando atributos para a requisição post para que seja salvo no back-end
            axios.post(this.urlBase, formData, cfg)
                .then(response => {
                    swal("Sucesso!", `Modelo ${this.novoModelo} cadastrado com sucesso!`, "success");
                    this.carregarMarcas()
                })
                .catch(errors => {
                    swal("Erro!", `Ocorreu o seguinte erro: ${errors.response}.`, "error");
                })
        }
    },
    mounted() {
        this.carregarDadosMarcas()
    }
}
</script>