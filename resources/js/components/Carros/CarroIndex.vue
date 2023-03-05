<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca de carros -->
                <card-component titulo="Busca de Carros">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                    texto-ajuda="(Opcional) Informe o ID do Carro">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                        placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Placa do Carro" id="inputPlaca" id-help="placaHelp"
                                    texto-ajuda="(Opcional) Informe a placa do Carro">
                                    <input type="text" class="form-control" id="inputPlaca" aria-describedby="placaHelp"
                                        placeholder="AAA-0000">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de carros -->

                <!-- Card de Listagem de carros -->
                <card-component titulo="Relação de Carros">
                    <template v-slot:conteudo>
                        <table-component 
                        :dados="carros.data"
                        :visualizar="{
                            visivel: true,
                            dataToggle: 'modal',
                            dataTarget: '#modalCarroVisualizar'
                        }" :editar="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalCarroEditar'
                        }" :deletar="{
                                dataToggle: 'modal',
                                dataTarget: '#modalCarroDeletar',
                                visivel: true
                        }" :titulos="{
                                id: { titulo: 'ID', tipo: 'texto' },
                                modelo: { titulo: 'Modelo', tipo: 'array' },
                                placa: { titulo: 'Placa', tipo: 'texto' },
                        }">
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <pagination-component>
                                    <li :class="li.active ? 'page-item active' : 'page-item'"
                                        v-for="li, key in carros.links" :key="key" @click="paginacao(li)">
                                        <a class="page-link" v-html="li.label"></a>
                                    </li>
                                </pagination-component>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm adicionar" data-bs-toggle="modal"
                                    data-bs-target="#modalCarro">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- Fim do Card de Listagem de carros -->

                <!-- Modal de cadastro de carro -->
                <modal-component id="modalCarro" titulo="Cadastro de Carro">
                    <template v-slot:conteudo>
                        <div class="form-group">
                            <input-container-component titulo="Modelo do Carro" id="carroModelo" id-help="carroModeloHelp"
                                texto-ajuda="(Obrigatório) Informe o modelo do carro">
                                <select class="form-select" aria-label="numeroPortas" v-model="carroModelo">
                                    <option v-for="item, key in modelos.data" :key="key" :value="item[0]">{{ item[1] }}</option>
                                </select>
                            </input-container-component>
                            <input-container-component titulo="Placa do Carro" id="placa" id-help="placaHelp"
                                texto-ajuda="(Obrigatório) Informe a placa do carro">
                                <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                                    placeholder="AAA-0000" v-model="placa" required>
                            </input-container-component>
                            <input-container-component titulo="Disponibilidade" id="disponibilidadeModelo" id-help="disponibilidadeHelp"
                                texto-ajuda="(Obrigatório) Informe a disponibilidade do carro">
                                <select class="form-select" aria-label="disponibilidadeModelo" id="disponibilidadeModelo" v-model="disponivel">
                                    <option value="1">Disponivel</option>
                                    <option value="0">Indisponivel</option>
                                </select>
                            </input-container-component>
                            <input-container-component titulo="KM atual do Carro" id="kmCarro" id-help="kmHelp"
                                texto-ajuda="(Obrigatório) Informe a km do carro">
                                <input type="text" class="form-control" id="kmCarro" aria-describedby="kmCarroHelp"
                                    placeholder="1000" v-model="kmCarro" required>
                            </input-container-component>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" @click="salvar()">Salvar Modelo</button>
                    </template>
                </modal-component>
                <!-- Fim do modal de cadastro de carro -->

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            multiple: {
                type: Boolean,
                default: true
            },
        },
        data() {
            return {
                urlBase: 'http://127.0.0.1:8000/api/v1/carro',
                urlPaginacao: '',
                urlFiltro: '',
                carroModelo: '',
                placa: '',
                disponivel: '',
                kmCarro: '',
                feedbackStatus: '',
                feedbackMessage: [],
                carros: {
                    data: []
                },
                modelos: {
                    data: []
                },
                busca: { id: '', placa: '' }
            }
        },
        methods: {
            paginacao(li) {
                if (li.url) {
                    this.urlPaginacao = li.url.split('?')[1];
                    this.carregarCarros() // requisitando novamente os dados para nossa API com base na URL atualizada
                }
            },
            carregarCarros() {
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro;
                axios.get(url)
                    .then(response => {
                        this.carros = response.data
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
            carregarDadosModelos() {
                let urlModelos = 'http://127.0.0.1:8000/api/v1/modelo?all'
                axios.get(urlModelos)
                    .then(response => {
                        let modelosDados = response.data
                        modelosDados.forEach((valorAtual) => {
                            var dadosModelo = [valorAtual.id, valorAtual.nome];
                            this.modelos.data.push(dadosModelo)
                        })
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
            salvar() {
                // instanciando um formulário para definir os atributos
                let formData = new FormData();
                formData.append('modelo_id', this.carroModelo);
                formData.append('placa', this.placa);
                formData.append('disponivel', this.disponivel);
                formData.append('km', this.kmCarro);

                // cabeçalhos da requisição
                let cfg = {
                    headres: {
                        'Content-Type': 'multipart/form-data',
                    }
                }

                // enviando atributos para a requisição post para que seja salvo no back-end
                axios.post(this.urlBase, formData, cfg)
                    .then(response => {
                        swal("Sucesso!", `Carro ${this.placa} cadastrado com sucesso!`, "success");
                        this.carregarCarros()
                    })
                    .catch(errors => {
                        swal("Erro!", `Ocorreu o seguinte erro: ${errors.response}.`, "error");
                    })
            },
        },
        mounted() {
        this.carregarCarros()
        this.carregarDadosModelos()
        }
    }
</script>