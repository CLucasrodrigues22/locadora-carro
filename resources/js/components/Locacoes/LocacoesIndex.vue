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
                  {{
                    $filters.formataDataptbr(
                      $store.state.item.data_inicio_periodo
                    )
                  }}
                </div>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-start"
              >
                <div class="ms-2 me-auto">
                  <div class="fw-bold">Data para devolução (previsão)</div>
                  {{
                    $filters.formataDataptbr(
                      $store.state.item.data_final_previsto_periodo
                    )
                  }}
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
              class="btn btn-success"
              title="Extrato PDF"
              v-if="$store.state.item.status_id != 1"
              @click="gerarPdf()"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-file-pdf"
                viewBox="0 0 16 16"
              >
                <path
                  d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"
                />
                <path
                  d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"
                />
              </svg>
              Gerar PDF
            </button>
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
import { jsPDF } from "jspdf";
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
      let data1 = d1.toLocaleDateString("en-CA");
      let data2 = d2.toLocaleDateString("en-CA");

      const diffInMs = new Date(data2) - new Date(data1);
      const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

      swal({
        title: "Você realmente deseja finalizar essa locação?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Fechar", "Finalizar Locação"],
      }).then((willDelete) => {
        if (willDelete) {
          let formData = new FormData();
          formData.append("_method", "patch");
          formData.append("km_final", this.kmVeiculoFinal);
          formData.append("km_percorrido", kmPercorrido);
          formData.append("total_dias_locacao", diffInDays);
          formData.append("valorLocacao", valorLocacao);
          formData.append("status_id", this.statusLocacao);
          formData.append("data_final_realizado_periodo", this.dataFinal);
          let url = this.urlBase + "/" + this.$store.state.item.id;

          axios
            .post(url, formData)
            .then((response) => {
              swal("Locação finalizada com sucesso!", {
                icon: "success",
              });
              this.carregarLocacoes();
            })
            .catch((errors) => {
              swal(
                "Erro!",
                `Ocorreu um erro na finalização da locação: erro ${errors.response.data.message}`,
                "error"
              );
              console.log(errors.response);
            });
        }
      });
    },
    gerarPdf() {
      const doc = new jsPDF();

      if (this.$store.state.item.status_id === 2) {
        doc.text(
          `
            Locação n°: ${this.$store.state.item.id}
            Cliente: ${this.$store.state.item.cliente.nome}
            Placa do carro: ${this.$store.state.item.carro.placa}
            Inicio do Aluguel: ${this.$store.state.item.data_inicio_periodo}
            Status do aluguel: Cancelado 
            KM percorrido: ${this.$store.state.item.km_percorrido}
            Valor tatol: ${this.$store.state.item.valor_diaria}
         `,
          10,
          10
        );
      } else {
        doc.text(
          `
            Locação n°: ${this.$store.state.item.id}
            Cliente: ${this.$store.state.item.cliente.nome}
            Placa do carro: ${this.$store.state.item.carro.placa}
            Inicio do Aluguel: ${this.$store.state.item.data_inicio_periodo}
            Término do Aluguel: ${this.$store.state.item.data_final_realizado_periodo}
            Status do aluguel: Finalizado 
            KM percorrido: ${this.$store.state.item.km_percorrido}
            Valor tatol: ${this.$store.state.item.valor_diaria}
         `,
          10,
          10
        );
      }
      doc.save("extrato.pdf");
    },
  },
  mounted() {
    this.carregarLocacoes();
    this.carregarDadosClientes();
    this.carregarDadosCarros();
  },
};
</script>