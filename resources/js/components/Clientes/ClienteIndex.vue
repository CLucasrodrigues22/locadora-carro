<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card de busca de cliente -->
                <card-component titulo="Busca de Clientes">
                    <template v-slot:conteudo>
                        <div class="row">
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp"
                                    texto-ajuda="(Opcional) Informe o ID do cliente">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp"
                                        placeholder="ID" v-model="busca.id">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome do Cliente" id="inputNomeCliente" id-help="nomeHelp"
                                    texto-ajuda="(Opcional) Informe o nome do cliente">
                                    <input type="text" class="form-control" id="inputNomeCliente" aria-describedby="nomeHelp"
                                        placeholder="Nome do Cliente" v-model="busca.nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left"
                            @click="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de cliente -->

                <!-- Card de Listagem de clientes -->
                <card-component titulo="Relação de Clientes">
                    <template v-slot:conteudo>
                        <table-component 
                        :dados="clientes.data"
                        :visualizar="{
                            visivel: true,
                            dataToggle: 'modal',
                            dataTarget: '#modalClienteVisualizar'
                        }" :editar="{
                                visivel: true,
                                dataToggle: 'modal',
                                dataTarget: '#modalClienteEditar'
                        }" :deletar="{
                                dataToggle: 'modal',
                                dataTarget: '#modalClienteDeletar',
                                visivel: true
                        }" :titulos="{
                                id: { titulo: 'ID', tipo: 'texto' },
                                nome: { titulo: 'Nome', tipo: 'texto' },
                        }">
                        </table-component>
                    </template>
                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <pagination-component>
                                    <li :class="li.active ? 'page-item active' : 'page-item'"
                                        v-for="li, key in clientes.links" :key="key" @click="paginacao(li)">
                                        <a class="page-link" v-html="li.label"></a>
                                    </li>
                                </pagination-component>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary btn-sm adicionar" data-bs-toggle="modal"
                                    data-bs-target="#modalCliente">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!-- Fim do Card de Listagem de clientes -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                urlBase: 'http://127.0.0.1:8000/api/v1/cliente',
                urlPaginacao: '',
                urlFiltro: '',
                clientes: {
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
                this.carregarClientes()
            },
            paginacao(li) {
                if (li.url) {
                    this.urlPaginacao = li.url.split('?')[1];
                    this.carregarClientes() // requisitando novamente os dados para nossa API com base na URL atualizada
                }
            },
            carregarClientes() {
                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro;
                axios.get(url)
                    .then(response => {
                        this.clientes = response.data
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            }
        },
        mounted() {
            this.carregarClientes()
        }
    }
</script>