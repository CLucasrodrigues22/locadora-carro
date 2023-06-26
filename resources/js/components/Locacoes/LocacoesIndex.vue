<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!-- Card de Listagem de locações -->
        <card-component titulo="Relação de Locações">
          <template v-slot:conteudo>
            <table-component
              :dados="locacoes.data"
              :visualizar="{
                visivel: true,
                dataToggle: 'modal',
                dataTarget: '#modalLocacoesVisualizar',
              }"
              :editar="{
                visivel: false,
                dataToggle: 'modal',
                dataTarget: '#modalLocacaoCancelar',
              }"
              :deletar="{
                dataToggle: 'modal',
                dataTarget: '#modalLocacoesDeletar',
                visivel: false,
              }"
              :finalizar="{
                dataToggle: 'modal',
                dataTarget: '#modalLocacoesFinalizar',
              }"
              :titulos="{
                id: { titulo: 'ID', tipo: 'texto' },
                cliente: { titulo: 'Cliente', tipo: 'array' },
                carro: { titulo: 'Placa do Carro', tipo: 'attr' },
                valor_diaria: { titulo: 'Valor da Diária', tipo: 'dinheiro' },
                status: { titulo: 'Status da Locação', tipo: 'status' },
              }"
            >
            </table-component>
          </template>
          <template v-slot:rodape>
            <div class="row">
              <div class="col-10">
                <pagination-component>
                  <li
                    :class="li.active ? 'page-item active' : 'page-item'"
                    v-for="(li, key) in carros.links"
                    :key="key"
                    @click="paginacao(li)"
                  >
                    <a class="page-link" v-html="li.label"></a>
                  </li>
                </pagination-component>
              </div>
              <div class="col-2">
                <button
                  type="button"
                  class="btn btn-primary btn-sm adicionar"
                  data-bs-toggle="modal"
                  data-bs-target="#modalLocacao"
                >
                  Adicionar
                </button>
              </div>
            </div>
          </template>
        </card-component>
        <!-- Fim do Card de Listagem de carros -->

        <!-- Modal de cadastro de locação -->
        <modal-component id="modalLocacao" titulo="Cadastro de Locação">
          <template v-slot:conteudo>
            <div class="form-group">
              <input-container-component
                titulo="Placa do Carro"
                id="placaCarro"
                id-help="placaCarroHelp"
                texto-ajuda="(Obrigatório) Informe a marca que o modelo pertence"
              >
                <select class="form-select" v-model="placaCarro">
                  <option
                    v-for="(item, key) in carros.data"
                    :key="key"
                    :value="item[0]"
                  >
                    {{ item[1] }}
                  </option>
                </select>
              </input-container-component>
              <input-container-component
                titulo="Nome do Cliente"
                id="nomeCliente"
                id-help="nomeClienteHelp"
                texto-ajuda="(Obrigatório) Informe a marca que o modelo pertence"
              >
                <select class="form-select" v-model="nomeCliente">
                  <option
                    v-for="(item, key) in clientes.data"
                    :key="key"
                    :value="item[0]"
                  >
                    {{ item[1] }}
                  </option>
                </select>
              </input-container-component>
              <input-container-component
                titulo="Início do Aluguel"
                id="inicioAluguel"
                id-help="inicioAluguelHelp"
                texto-ajuda="(Obrigatório) Informe o nome do modelo"
              >
                <input
                  type="date"
                  class="form-control"
                  id="incioAluguel"
                  aria-describedby="incioAluguelHelp"
                  v-model="inicioAluguel"
                  required
                />
              </input-container-component>
              <input-container-component
                titulo="Data Final do Aluguel (previsto)"
                id="dataFinalPrevista"
                id-help="dataFinalPrevistaHelp"
                texto-ajuda="(Obrigatório) Informe a Data Final do Aluguel (previsto)"
              >
                <input
                  type="date"
                  class="form-control"
                  id="dataFinalPrevista"
                  aria-describedby="dataFinalPrevistaHelp"
                  v-model="dataFinalPrevista"
                  required
                />
              </input-container-component>
              <input-container-component
                titulo="Valor da Diária"
                id="valorDiaria"
                id-help="valorDiariaHelp"
                texto-ajuda="(Obrigatório) Informe a Data Final do Aluguel"
              >
                <input
                  type="text"
                  class="form-control"
                  id="valorDiaria"
                  aria-describedby="valorDiariaHelp"
                  v-model="valorDiaria"
                  required
                />
              </input-container-component>
              <input-container-component
                titulo="KM inicial do Veículo"
                id="kmVeiculoIncio"
                id-help="kmVeiculoIncioHelp"
                texto-ajuda="(Obrigatório) Informe o km do veículo antes do aluguel"
              >
                <input
                  type="text"
                  class="form-control"
                  id="kmVeiculoIncio"
                  aria-describedby="kmVeiculoIncioHelp"
                  v-model="kmVeiculoIncio"
                  required
                />
              </input-container-component>
            </div>
          </template>
          <template v-slot:rodape>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fechar
            </button>
            <button type="button" class="btn btn-primary" @click="salvar()">
              Salvar Locação
            </button>
          </template>
        </modal-component>
        <!-- Fim do modal de cadastro de locação -->

        <!-- Modal de vizualização de locação -->
        <modal-component id="modalLocacoesVisualizar" titulo="Dados da Locação">
          <template v-slot:conteudo>
            <ol class="list-group list-group">
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">ID da Locação</div>
                  {{ $store.state.item.id }}
                </div>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Início do Aluguel</div>
                  {{ $store.state.item.data_inicio_periodo }}
                </div>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Data para devolução (previsão)</div>
                  {{ $store.state.item.data_final_previsto_periodo }}
                </div>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Valor total do Aluguel</div>
                  {{ $filters.formataDinheiro($store.state.item.valor_diaria) }}
                </div>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">KM inicial do carro</div>
                  {{ $store.state.item.km_inicial }}
                </div>
              </li>
            </ol>
          </template>
          <template v-slot:rodape>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fechar
            </button>
            <button
              v-if="$store.state.item.status_id == 1"
              type="button"
              class="btn btn-danger"
              @click="cancelarLocacao()"
            >
              Cancelar Locação
            </button>
          </template>
        </modal-component>
        <!-- Fim do modal de vizualização de modelo -->

        <modal-component id="modalLocacoesFinalizar" titulo="Finalizar Locação">
          <template v-slot:conteudo>
            <div class="form-group">
              <input-container-component
                titulo="Data de Entrega"
                id="dataFinal"
                id-help="dataFinalHelp"
                texto-ajuda="(Obrigatório) Informe a Data Final do Aluguel"
              >
                <input
                  type="date"
                  class="form-control"
                  id="dataFinal"
                  aria-describedby="dataFinalHelp"
                  v-model="dataFinal"
                  required
                />
              </input-container-component>
              <input-container-component
                titulo="KM final do veiculo"
                id="kmVeiculoFinal"
                id-help="kmVeiculoFinalHelp"
                texto-ajuda="(Obrigatório) Informe o km do veículo após a locação"
              >
                <input
                  type="text"
                  class="form-control"
                  id="kmVeiculoFinal"
                  aria-describedby="kmVeiculoFinalHelp"
                  v-model="kmVeiculoFinal"
                  required
                />
              </input-container-component>
              <input
                type="hidden"
                v-model="$store.state.item.data_inicio_periodo"
                id="dataInicio"
              />
            </div>
          </template>
          <template v-slot:rodape>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Fechar
            </button>
            <button
              v-if="$store.state.item.status_id != 3"
              type="button"
              class="btn btn-primary"
              @click="finalizarLocacao()"
            >
              Finalizar Locação
            </button>
          </template>
        </modal-component>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    multiple: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      urlBase: "http://127.0.0.1:8000/api/v1/locacao",
      urlPaginacao: "",
      placaCarro: "",
      nomeCliente: "",
      inicioAluguel: "",
      dataFinalPrevista: "",
      dataFinal: "",
      valorDiaria: "",
      kmVeiculoIncio: "",
      kmVeiculoFinal: 0,
      statusLocacao: "",
      locacoes: {
        data: [],
      },
      clientes: {
        data: [],
      },
      carros: {
        data: [],
      },
    };
  },
  methods: {
    paginacao(li) {
      if (li.url) {
        this.urlPaginacao = li.url.split("?")[1];
        this.carregarLocacoes(); // requisitando novamente os dados para nossa API com base na URL atualizada
      }
    },
    carregarLocacoes() {
      let url = this.urlBase + "?" + this.urlPaginacao;
      axios
        .get(url)
        .then((response) => {
          this.locacoes = response.data;
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    carregarDadosClientes() {
      let urlClientes = "http://127.0.0.1:8000/api/v1/cliente?all";
      axios
        .get(urlClientes)
        .then((response) => {
          let clientesDados = response.data;
          clientesDados.forEach((valorAtual) => {
            var dadosClientes = [valorAtual.id, valorAtual.nome];
            this.clientes.data.push(dadosClientes);
          });
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    carregarDadosCarros() {
      let urlCarros = "http://127.0.0.1:8000/api/v1/carro?all";
      axios
        .get(urlCarros)
        .then((response) => {
          let carroDados = response.data;
          carroDados.forEach((valorAtual) => {
            var dadosCarro = [valorAtual.id, valorAtual.placa];
            this.carros.data.push(dadosCarro);
          });
          //console.log(this.carros)
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    salvar() {
      let formData = new FormData();
      formData.append("cliente_id", this.nomeCliente);
      formData.append("carro_id", this.placaCarro);
      formData.append("data_inicio_periodo", this.inicioAluguel);
      formData.append("data_final_previsto_periodo", this.dataFinalPrevista);
      formData.append("valor_diaria", this.valorDiaria);
      formData.append("km_inicial", this.kmVeiculoIncio);

      // enviando atributos para a requisição post para que seja salvo no back-end
      axios
        .post(this.urlBase, formData)
        .then((response) => {
          swal("Sucesso!", `Locação cadastrada com sucesso!`, "success");
          this.carregarLocacoes();
        })
        .catch((errors) => {
          swal(
            "Erro!",
            `Ocorreu o seguinte erro: ${errors.response.data.message}.`,
            "error"
          );
          // console.log(errors.response.data.message)
        });
    },
    cancelarLocacao() {
      swal({
        title: "Você realmente deseja cancelar essa locação?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Fechar", "Cancelar Locação"],
      }).then((willDelete) => {
        if (willDelete) {
          let formData = new FormData();
          formData.append("_method", "patch");
          formData.append("status_id", 2); // status de locação cancelada

          let url = this.urlBase + "/" + this.$store.state.item.id;

          axios
            .post(url, formData)
            .then((response) => {
              swal("Locação cancelada com sucesso!", {
                icon: "success",
              });
              this.carregarLocacoes();
            })
            .catch((errors) => {
              swal(
                "Erro!",
                `Ocorreu um erro na edição do modelo: erro ${errors.response.data.message}`,
                "error"
              );
              console.log(errors.response);
            });
        }
      });
    },
    finalizarLocacao() {
      this.statusLocacao = 3; // status de locação finalizada
      // calcular o km percorrido durante a locação
      let kmPercorrido =
        this.kmVeiculoFinal - this.$store.state.item.km_inicial;

      // tempo de aluguel
      let t1 = this.$store.state.item.data_inicio_periodo;
      let t2 = this.dataFinal;
      let d1 = new Date(t1);
      let d2 = new Date(t2);
      let data1 = d1.toLocaleDateString();
      let data2 = d2.toLocaleDateString();

      const diffInMs = new Date(data2) - new Date(data1);
      //const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
      console.log(diffInMs);

      // swal({
      //     title: "Você realmente deseja finalizar essa locação?",
      //     icon: "warning",
      //     buttons: true,
      //     dangerMode: true,
      //     buttons: ["Fechar", "Finalizar Locação"],
      // })
      //     .then((willDelete) => {
      //         if (willDelete) {
      //             let formData = new FormData();
      //             formData.append('_method', 'patch')
      //             formData.append('km_final', this.kmVeiculoFinal);
      //             formData.append('km_percorrido', kmPercorrido);
      //             formData.append('total_dias_locacao', totalDiasLocacao);
      //             formData.append('valorLocacao', valorLocacao);
      //             formData.append('status_id', this.statusLocacao);
      //             formData.append('data_final_realizado_periodo', this.dataFinal);
      //             let url = this.urlBase + '/' + this.$store.state.item.id

      //             axios.post(url, formData)
      //                 .then(response => {
      //                     swal("Locação finalizada com sucesso!", {
      //                         icon: "success",
      //                     });
      //                     this.carregarLocacoes()
      //                 })
      //                 .catch(errors => {
      //                     swal("Erro!", `Ocorreu um erro na finalização da locação: erro ${errors.response.data.message}`, "error");
      //                     console.log(errors.response)
      //                 })
      //         }
      //     });
    },
  },
  mounted() {
    this.carregarLocacoes();
    this.carregarDadosClientes();
    this.carregarDadosCarros();
  },
};
</script>