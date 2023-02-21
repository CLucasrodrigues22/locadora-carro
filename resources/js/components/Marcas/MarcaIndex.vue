<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca de marca -->
                <card-component titulo="Busca de marcas">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                    texto-ajuda="(Opcional) Informe o ID da marca">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                        placeholder="ID" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome da Marca" id="inputNome" id-help="nomeHelp"
                                    texto-ajuda="(Opcional) Informe o nome da marca">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp"
                                        placeholder="Nome da Marca" v-model="busca.nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left"
                            @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de marca -->

                <!-- Card de Listagem de marca -->
                <card-component titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <table-component :dados="marcas.data" 
                        :visualizar="{
                            visivel: true,
                            dataToggle: 'modal',
                            dataTarget: '#modalMarcaVisualizar'
                        }" :editar="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalMarcaEditar'
                        }" :deletar="{
                                dataToggle: 'modal',
                                dataTarget: '#modalMarcaDeletar',
                                visivel: true
                        }" :titulos="{
                                id: { titulo: 'ID', tipo: 'texto' },
                                nome: { titulo: 'Nome', tipo: 'texto' },
                                imagem: { titulo: 'Imagem', tipo: 'imagem' },
                        }">
                        </table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <pagination-component>
                                    <li :class="li.active ? 'page-item active' : 'page-item'"
                                        v-for="li, key in marcas.links" :key="key" @click="paginacao(li)">
                                        <a class="page-link" v-html="li.label"></a>
                                    </li>
                                </pagination-component>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm adicionar" data-bs-toggle="modal"
                                    data-bs-target="#modalMarca">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- Fim do Card de Listagem de marca -->
            </div>
        </div>
        <!-- Modal de cadastro de marca -->
        <modal-component id="modalMarca" titulo="Cadastro de Marca">
            <template v-slot:alerta>
                <alert-component classe="success" :feedback="feedbackMessage" conteudo="Marca cadastrada com sucesso."
                    v-if="this.feedbackStatus == 'sucesso'"></alert-component>
                <alert-component classe="danger" :feedback="feedbackMessage"
                    conteudo="Ocorreu o(s) seguinte(s) erro(s) ao cadastrar a nova Marca: "
                    v-if="this.feedbackStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da Marca" id="novaMarca" id-help="novaMarcaHelp"
                        texto-ajuda="(Obrigatório) Informe o nome da marca">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                            placeholder="Nome da marca" v-model="novaMarca" required>
                    </input-container-component>
                    <input-container-component titulo="Imagem da Marca" id="novaImagem" name="novaImagem"
                        id-help="imagemHelp" texto-ajuda="(Obrigatório) Selecione a imagem da Marca">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="imagemHelp"
                            @change="carregarImagem($event)" required>
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar Marca</button>
            </template>
        </modal-component>
        <!-- Fim do modal de cadastro de marca -->

        <!-- Modal de vizualização de marca -->
        <modal-component id="modalMarcaVisualizar" titulo="Dados da Marca">
            <template v-slot:alerta>

            </template>
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" readonly :value="$store.state.item.id">
                </input-container-component>
                <input-container-component titulo="Nome da Marca">
                    <input type="text" class="form-control" readonly :value="$store.state.item.nome">
                </input-container-component>
                <input-container-component titulo="Logo da Marca">
                    <img :src="'storage/' + $store.state.item.imagem" alt="Logo da Marca" v-if="$store.state.item.imagem">
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </template>
        </modal-component>
        <!-- Fim do modal de vizualização de marca -->

        <!-- Modal de exclusão de marca -->
        <modal-component id="modalMarcaDeletar" titulo="Dados da marca a ser removida">
            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" readonly :value="$store.state.item.id">
                </input-container-component>
                <input-container-component titulo="Nome da Marca">
                    <input type="text" class="form-control" readonly :value="$store.state.item.nome">
                </input-container-component>
            </template>
            <template v-slot:rodape>
                <div class="btnDeletar">
                    <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger m-1" @click="deletar($store.state.item)">Deletar</button>
                </div>
            </template>
        </modal-component>
        <!-- Fim do modal de exclusão de marca -->

        <!-- Modal de edição de marca -->
        <modal-component id="modalMarcaEditar" titulo="Dados da marca">
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da Marca" id="novaMarca" id-help="novaMarcaHelp"
                        texto-ajuda="(Opcional) Informe o nome da marca">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                            placeholder="Nome da marca" v-model="$store.state.item.nome">
                    </input-container-component>
                    <input-container-component titulo="Imagem da Marca" id="novaImagem" name="novaImagem"
                        id-help="imagemHelp" texto-ajuda="(Opcional) Selecione a imagem da Marca">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="imagemHelp"
                            @change="carregarImagem($event)">
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <div class="btnDeletar">
                    <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary m-1" @click="editar($store.state.item)">Editar</button>
                </div>
            </template>
        </modal-component>
        <!-- Fim do modal de edição de marca -->
    </div>
</template>

<script>
export default {
    computed: {
        token() {
            // separar o objeto cookie atravez do ; para resgatar o atributo token
            let token = document.cookie.split(';').find(indice => {
                return indice.startsWith('token=');

                // separando o atributo token pelo "=" para resgatar apenas o valor do mesmo
                token = token.split('=')[1];
                token = 'Bearer ' + token;

                return token
            });
        }
    },
    data() {
        return {
            urlBase: 'http://127.0.0.1:8000/api/v1/marca',
            urlPaginacao: '',
            urlFiltro: '',
            novaMarca: '',
            imagemMarca: [],
            feedbackStatus: '',
            feedbackMessage: [],
            marcas: {
                data: []
            },
            busca: { id: '', nome: '' }
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
            this.carregarMarcas()
        },
        paginacao(li) {
            if (li.url) {
                this.urlPaginacao = li.url.split('?')[1];
                this.carregarMarcas() // requisitando novamente os dados para nossa API com base na URL atualizada
            }
        },
        carregarMarcas() {
            let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro;
            axios.get(url)
                .then(response => {
                    this.marcas = response.data
                    //console.log(this.marcas)
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        carregarImagem(e) {
            this.imagemMarca = e.target.files
        },
        salvar() {
            //console.log(this.novaMarca, this.imagemMarca[0])
            // instanciando um formulário para definir os atributos
            let formData = new FormData();
            formData.append('nome', this.novaMarca);
            formData.append('imagem', this.imagemMarca[0]);

            // cabeçalhos da requisição
            let cfg = {
                headres: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }

            // enviando atributos para a requisição post para que seja salvo no back-end
            axios.post(this.urlBase, formData, cfg)
                .then(response => {
                    swal("Sucesso!", `Marca ${this.novaMarca} cadastrada com sucesso!`, "success");
                    this.feedbackStatus = 'sucesso'
                    this.feedbackMessage = response
                    this.carregarMarcas()
                })
                .catch(errors => {
                    this.feedbackStatus = 'erro'
                    this.feedbackMessage = errors.response
                })
        },
        deletar(item) {
            swal({
                title: "Você tem certeza?",
                text: `Ao confirmar o exclusão, todos os dados de ${item.nome} serão removidos permanentimente da base de dados.`,
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
                        // criando os headers
                        let cfg = {
                            headres: {
                                'Accept': 'application/json',
                                'Authorization': this.token
                            }
                        }

                        axios.post(url, formData, cfg)
                            .then(response => {
                                swal(`A marca ${item.nome} foi removida com sucesso!`, {
                                    icon: "success",
                                });
                                this.carregarMarcas()
                            })
                            .catch(errors => {
                                swal(`Ocorreu um erro ao tentar deletar dados de marca ${item.nome} do banco de dados.`, {
                                    icon: "danger",
                                });
                            })
                    }
                });
        },
        editar(item) {
            // criando url para edição
            let url = this.urlBase + '/' + this.$store.state.item.id

            let formData = new FormData();
            formData.append('_method', 'patch');
            formData.append('nome', item.nome);
            formData.append('imagem', this.imagemMarca[0]);

            // criando os headers
            let cfg = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json',
                    'Authorization': this.token
                }
            }
            axios.post(url, formData, cfg)
                .then(response => {
                    console.log(response)
                })
                .catch(errors => {
                    console.log(errors)
                })
        }
    },
    mounted() {
        this.carregarMarcas()
    }
}
</script>