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
                                        placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome da Marca" id="inputNome" id-help="nomeHelp"
                                    texto-ajuda="(Opcional) Informe o nome da marca">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp"
                                        placeholder="Nome da Marca">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-left">Pesquisar</button>
                    </template>
                </card-component>
                <!-- Fim do card de busca de marca -->

                <!-- Card de Listagem de marca -->
                <card-component titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <table-component 
                            :dados="marcas"
                            :titulos="['ID', 'Imagem', 'Nome']"
                        ></table-component>
                    </template>

                    <template v-slot:rodape>
                        <button type="button" class="btn btn-primary btn-sm float-left" data-bs-toggle="modal"
                            data-bs-target="#modalMarca">Adicionar</button>
                    </template>
                </card-component>
                <!-- Fim do Card de Listagem de marca -->
            </div>
        </div>
        <modal-component id="modalMarca" titulo="Cadastro de Marca">
            <template v-slot:alerta>
                <alert-component classe="success" :feedback="feedbackMessage" conteudo="Marca cadastrada com sucesso." v-if="this.feedbackStatus == 'sucesso'"></alert-component>
                <alert-component classe="danger" :feedback="feedbackMessage" conteudo="Ocorreu o(s) seguinte(s) erro(s) ao cadastrar a nova Marca: " v-if="this.feedbackStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <div class="form-group">
                    <input-container-component titulo="Nome da Marca" id="novaMarca" id-help="novaMarcaHelp"
                        texto-ajuda="(Obrigatório) Informe o nome da marca">
                        <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="novaMarca" required>
                    </input-container-component>
                    <input-container-component titulo="Imagem da Marca" id="novaImagem" name="novaImagem" id-help="imagemHelp"
                        texto-ajuda="(Obrigatório) Selecione a imagem da Marca">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="imagemHelp" @change="carregarImagem($event)" required>
                    </input-container-component>
                </div>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar Marca</button>
            </template>
        </modal-component>
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
                novaMarca: '',
                imagemMarca: [],
                feedbackStatus: '',
                feedbackMessage: [],
                marcas: []
            }
        },
        methods: {
            carregarMarcas() {
                axios.get(this.urlBase)
                    .then(response => {
                        this.marcas = response.data
                        console.log(this.marcas)
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },
            carregarImagem(e) {
                this.imagemMarca = e.target.files
            },
            salvar() {
                console.log(this.novaMarca, this.imagemMarca[0])
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
                        this.feedbackStatus = 'sucesso'
                        this.feedbackMessage = response
                    })
                    .catch(errors => {
                        this.feedbackStatus = 'erro'
                        this.feedbackMessage = errors.response
                    })
            }
        },
        mounted() {
            this.carregarMarcas()
        }
    }
</script>