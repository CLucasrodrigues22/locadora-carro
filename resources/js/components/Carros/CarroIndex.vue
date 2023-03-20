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
                                        placeholder="ID" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Placa do Carro" id="inputPlaca" id-help="placaHelp"
                                    texto-ajuda="(Opcional) Informe a placa do Carro">
                                    <input type="text" class="form-control" id="inputPlaca" aria-describedby="placaHelp"
                                        placeholder="AAA-0000" v-model="busca.placa">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left"
                            @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de carros -->

                <!-- Card de Listagem de carros -->
                <card-component titulo="Relação de Carros">
                    <template v-slot:conteudo>
                        <table-component :dados="carros.data" 
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

                <!-- Modal de vizualização de modelo -->
                <modal-component id="modalCarroVisualizar" titulo="Dados do Carro">
                    <template v-slot:conteudo>
                        <div class="card">
                            <div class="card-body">
                                <ol class="list-group list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"> Placa do carro</div>
                                            {{ $store.state.item.placa }}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"> Disponivel</div>
                                            {{ $store.state.item.disponivel != 1 ? 'Carro não disponível' : 'Carro disponível' }}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">KM atual</div>
                                            {{ $store.state.item.km }} km
                                        </div>
                                    </li>
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">ABS</div>
                                            {{ $store.state.item.abs != 1 ? 'Não possui ABS' : 'Possui ABS' }}
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </template>
                </modal-component>
                <!-- Fim do modal de vizualização de modelo -->

                <!-- Modal de cadastro de carro -->
                <modal-component id="modalCarro" titulo="Cadastro de Carro">
                    <template v-slot:conteudo>
                        <div class="form-group">
                            <input-container-component titulo="Modelo do Carro" id="carroModelo" id-help="carroModeloHelp"
                                texto-ajuda="(Obrigatório) Informe o modelo do carro">
                                <select class="form-select" aria-label="numeroPortas" v-model="carroModelo">
                                    <option v-for="item, key in modelos.data" :key="key" :value="item[0]">{{ item[1] }}
                                    </option>
                                </select>
                            </input-container-component>
                            <input-container-component titulo="Placa do Carro" id="placa" id-help="placaHelp"
                                texto-ajuda="(Obrigatório) Informe a placa do carro">
                                <input type="text" class="form-control" id="novaPlacaCarro" aria-describedby="novoNomeHelp"
                                    placeholder="AAA-0000" v-model="placa" required>
                            </input-container-component>
                            <input-container-component titulo="Disponibilidade" id="disponibilidadeModelo"
                                id-help="disponibilidadeHelp"
                                texto-ajuda="(Obrigatório) Informe a disponibilidade do carro">
                                <select class="form-select" aria-label="disponibilidadeModelo" id="disponibilidadeModelo"
                                    v-model="disponivel">
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

                <!-- Modal de edição de carro -->
                <modal-component id="modalCarroEditar" titulo="Dados do Carro">
                    <template v-slot:conteudo>
                        <div class="form-group">
                            <input-container-component titulo="ID do Carro" id="idCarro" id-help="idCarroHelp">
                                <input type="number" class="form-control" id="idCarro" aria-describedby="idCarroHelp" v-model="$store.state.item.id" readonly>
                            </input-container-component>
                            <input-container-component titulo="Modelo do Carro" id="carroModelo" id-help="carroModeloHelp"
                                texto-ajuda="(Obrigatório) Informe o modelo do carro">
                                <select class="form-select" aria-label="numeroPortas" v-model="$store.state.item.modelo_id">
                                    <option v-for="item, key in modelos.data" :key="key" :value="item[0]">{{ item[1] }}
                                    </option>
                                </select>
                            </input-container-component>
                            <input-container-component titulo="Placa do Carro" id="novaPlaca" idq-help="novaPlacaHelp"
                                texto-ajuda="(Opcional) Informe a nova placa do carro">
                                <input type="text" class="form-control" id="novaPlaca" aria-describedby="novaPlacaHelp"
                                    placeholder="AAA-0000" v-model="$store.state.item.placa">
                            </input-container-component>
                            <input-container-component titulo="Disponibilidade" id="disponibilidade" id-help="disponibilidadeHelp"
                                texto-ajuda="(Opcional) Informe a disponibilidade do carro">
                                <select class="form-select" aria-label="disponibilidade" v-model="$store.state.item.disponivel">
                                    <option value="1">Disponivel</option>
                                    <option value="0">Indisponivel</option>
                                </select>
                            </input-container-component>
                            <input-container-component titulo="KM" id="novoKM" id-help="novoKMHelp"
                                texto-ajuda="(Opcional) Informe quilometragem do Carro">
                                <input type="text" class="form-control" id="novoKM" aria-describedby="novoKMHelp"
                                    placeholder="1000" v-model="$store.state.item.km">
                            </input-container-component>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <div class="btnDeletar">
                            <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary m-1"
                                @click="editar($store.state.item)">Editar</button>
                        </div>
                    </template>
                </modal-component>
                <!-- Fim do modal de edição de carro -->

                 <!-- Modal de exclusão de carro -->
                 <modal-component id="modalCarroDeletar" titulo="Dados do Carro a ser removida">
                    <template v-slot:conteudo>
                        <input-container-component titulo="ID">
                            <input type="text" class="form-control" readonly :value="$store.state.item.id">
                        </input-container-component>
                        <input-container-component titulo="Placa">
                            <input type="text" class="form-control" readonly :value="$store.state.item.placa">
                        </input-container-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="btnDeletar">
                            <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-danger m-1"
                                @click="deletar($store.state.item)">Deletar</button>
                        </div>
                    </template>
                </modal-component>
                <!-- Fim do modal de exclusão de carro -->
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
            pesquisar() {
                let filtro = ''

                for (let chave in this.busca) {
                    if (this.busca[chave]) {
                        if (filtro != '') {
                            filtro += ";"
                        }

                        filtro += chave + ':like:' + this.busca[chave];
                    }
                }
                if (filtro != '') {
                    this.urlPaginacao = 'page=1';
                    this.urlFiltro = '&filtro=' + filtro;
                } else {
                    this.urlFiltro = ''
                }
                this.carregarCarros()
            },
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

                // enviando atributos para a requisição post para que seja salvo no back-end
                axios.post(this.urlBase, formData)
                    .then(response => {
                        swal("Sucesso!", `Carro ${this.placa} cadastrado com sucesso!`, "success");
                        this.carregarCarros()
                    })
                    .catch(errors => {
                        swal("Erro!", `Ocorreu o seguinte erro: ${errors.response}.`, "error");
                    })
            },
            editar() {
                let formData = new FormData();
                formData.append('_method', 'patch');
                formData.append('modelo_id', this.$store.state.item.modelo_id);
                formData.append('placa', this.$store.state.item.placa);
                formData.append('disponivel', this.$store.state.item.disponivel);
                formData.append('km', this.$store.state.item.km);

                let url = this.urlBase + '/' + this.$store.state.item.id

                axios.post(url, formData)
                    .then(response => {
                        swal("Sucesso!", `Carro editado com sucesso!`, "success");
                        this.carregarCarros()
                    })
                    .catch(errors => {
                        swal("Erro!", `Ocorreu um erro na edição: ${errors.response.data.message}`, "error");
                    })
            },
            deletar(item) {
                swal({
                    title: "Você tem certeza?",
                    text: `Ao confirmar o exclusão, todos os dados do carro placa: ${item.placa} serão removidos permanentimente da base de dados.`,
                    icon: "warning",
                    buttons: ["Cancelar", "Deletar"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // criando url para delete
                        let url = this.urlBase + '/' + this.$store.state.item.id
                        // criando uma instância de forData e passando o metodo para delete
                        let formData = new FormData();
                        formData.append('_method', 'delete');

                        axios.post(url, formData)
                            .then(response => {
                                swal(`Carro placa: ${item.placa} foi removida com sucesso!`, {
                                    icon: "success",
                                });
                                this. carregarCarros()
                            })
                            .catch(errors => {
                                swal(`Erro, verifique se o carro ${item.placa} está alugado.`, {
                                    icon: "error",
                                });
                                console.log(errors)
                            })
                    }
                });
            }
        },
        mounted() {
            this.carregarCarros()
            this.carregarDadosModelos()
        }
    }
</script>