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
                                    <input type="text" class="form-control" id="inputNomeCliente"
                                        aria-describedby="nomeHelp" placeholder="Nome do Cliente" v-model="busca.nome">
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
                        <table-component :dados="clientes.data" :visualizar="{
                            visivel: true,
                            dataToggle: 'modal',
                            dataTarget: '#modalClienteVisualizar'
                        }" :editar="{
    visivel: true,
    dataToggle: 'modal',
    dataTarget: '#modalClienteEditar'
}" :finalizar="{
    dataToggle: 'modal',
    dataTarget: '#modalLocacoesFinalizar',
    visivel: false
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

                <!-- Modal de cadastro de cliente -->
                <modal-component id="modalCliente" titulo="Cadastro de Cliente">
                    <template v-slot:conteudo>
                        <div class="form-group">
                            <input-container-component titulo="Nome do Cliente" id="novoCliente" id-help="novoClienteHelp"
                                texto-ajuda="(Obrigatório) Informe o nome do Cliente">
                                <input type="text" class="form-control" id="novoCliente" aria-describedby="novoClienteHelp"
                                    placeholder="Nome do Cliente" v-model="novoCliente" required>
                            </input-container-component>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" @click="salvar()">Salvar Cliente</button>
                    </template>
                </modal-component>
                <!-- Fim do modal de cadastro de cliente -->

                <!-- Modal de vizualização de cliente -->
                <modal-component id="modalClienteVisualizar" titulo="Dados do Cliente">
                    <template v-slot:conteudo>
                        <div class="card">
                            <div class="card-body">
                                <ol class="list-group list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">ID do Cliente</div>
                                            {{ $store.state.item.id }}
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nome do Cliente</div>
                                            {{ $store.state.item.nome }}
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
                <!-- Fim do modal de vizualização de cliente -->

                <!-- Modal de edição de clientes -->
                <modal-component id="modalClienteEditar" titulo="Dados do Cliente">
                    <template v-slot:conteudo>
                        <div class="form-group">
                            <input-container-component titulo="ID do Cliente" id="idCliente" id-help="idClienteHelp">
                                <input type="number" class="form-control" id="idCliente" aria-describedby="idClienteHelp"
                                    v-model="$store.state.item.id" readonly>
                            </input-container-component>
                            <input-container-component titulo="Nome do Cliente" id="novoNome" idq-help="novoNomeHelp"
                                texto-ajuda="(Opcional) Informe o novo Nome do Cliente">
                                <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp"
                                    placeholder="Ex: Lucas Rodrigues" v-model="$store.state.item.nome">
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
                <!-- Fim do modal de edição de clientes -->

                <!-- Modal de exclusão de cliente -->
                <modal-component id="modalClienteDeletar" titulo="Dados do Cliente a ser removida">
                    <template v-slot:conteudo>
                        <input-container-component titulo="ID">
                            <input type="text" class="form-control" readonly :value="$store.state.item.id">
                        </input-container-component>
                        <input-container-component titulo="Nome">
                            <input type="text" class="form-control" readonly :value="$store.state.item.nome">
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
                <!-- Fim do modal de exclusão de cliente -->
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
            novoCliente: '',
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
        },
        salvar() {
            // instanciando um formulário para definir os atributos
            let formData = new FormData();
            formData.append('nome', this.novoCliente);

            // enviando atributos para a requisição post para que seja salvo no back-end
            axios.post(this.urlBase, formData)
                .then(response => {
                    swal("Sucesso!", `Cliente ${this.novoCliente
                        } cadastrado com sucesso!`, "success");
                    this.carregarClientes()
                })
                .catch(errors => {
                    swal("Erro!", `Ocorreu o seguinte erro: ${errors.response.data.message}.`, "error");
                })
        },
        editar() {
            let formData = new FormData();
            formData.append('_method', 'patch');
            formData.append('nome', this.$store.state.item.nome);

            let url = this.urlBase + '/' + this.$store.state.item.id

            axios.post(url, formData)
                .then(response => {
                    swal("Sucesso!", `Cliente ${this.$store.state.item.nome} editado com sucesso!`, "success");
                    this.carregarClientes()
                })
                .catch(errors => {
                    swal("Erro!", `Ocorreu um erro na edição: ${errors.response}`, "error");
                    console.log(errors)
                })
        },
        deletar(item) {
            swal({
                title: "Você tem certeza?",
                text: `Ao confirmar o exclusão, todos os dados do cliente ${this.$store.state.item.nome} serão removidos permanentimente da base de dados.`,
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
                                swal(`Cliente ${item.cliente} foi removido com sucesso!`, {
                                    icon: "success",
                                });
                                this.carregarClientes()
                            })
                            .catch(errors => {
                                swal(`Erro, verifique se o cliente ${item.cliente} possui alguma locação em aberto.`, {
                                    icon: "error",
                                });
                                console.log(errors)
                            })
                    }
                });
        }
    },
    mounted() {
        this.carregarClientes()
    }
}
</script>