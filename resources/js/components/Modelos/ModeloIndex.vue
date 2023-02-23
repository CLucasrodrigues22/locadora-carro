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
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <img src="storage/imagens/modelos/Pu61a6c5gfWbXsWpqxV7ZxA8Qk1W4z6lUmbfu8BH.png"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Nome do modelo</h5>
                                        <ol class="list-group list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Número de portas</div>
                                                    4 Portas
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Lugares</div>
                                                    5 Lugares
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Air Bag</div>
                                                    Air Bag implementado
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">ABS</div>
                                                    ABS implementado
                                                </div>
                                            </li>
                                        </ol>
                                        <div class="d-inline">
                                            <button href="#" class="btn btn-info m-1" title="Editar">Dados da Marca</button>
                                            <button href="#" class="btn btn-warning m-1" title="Editar"><i class="bi bi-pencil"></i></button>
                                            <button href="#" class="btn btn-danger m-1" title="Deletar"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <img src="storage/imagens/modelos/Pu61a6c5gfWbXsWpqxV7ZxA8Qk1W4z6lUmbfu8BH.png"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Nome do modelo</h5>
                                        <ol class="list-group list-group mb-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Número de portas</div>
                                                    4 Portas
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Lugares</div>
                                                    5 Lugares
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">Air Bag</div>
                                                    Air Bag implementado
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold">ABS</div>
                                                    ABS implementado
                                                </div>
                                            </li>
                                        </ol>
                                        <div class="d-inline">
                                            <button href="#" class="btn btn-info m-1" title="Editar">Dados da Marca</button>
                                            <button href="#" class="btn btn-warning m-1" title="Editar"><i class="bi bi-pencil"></i></button>
                                            <button href="#" class="btn btn-danger m-1" title="Deletar"><i class="bi bi-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">

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
    </div>
</template>

<script>
export default {

}
</script>