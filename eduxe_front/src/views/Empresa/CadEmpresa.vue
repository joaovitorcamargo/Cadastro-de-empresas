<template>
  <div class="cadEmpresa d-flex justify-content-center align-items-start">
    <div class="container">
      <loading
        class="background-loading"
        :active.sync="isLoading"
        :can-cancel="false"
      >
        <h2 class="title_loading">Carregando...</h2>
      </loading>
      <form @submit.prevent="enviarDados">
        <div class="form-group">
          <label for="inputCnpj">CNPJ</label>
          <the-mask
            v-model="cnpj"
            type="text"
            class="form-control"
            id="inputCnpj"
            placeholder="Digite o CNPJ"
            :mask="['##.###.###/####-##']"
          />
        </div>
        <div v-show="show_form">
          <div
            class="row"
            v-for="(empresa, key, index) in dados_form"
            :key="index + empresa.nome"
          >
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputRazaoSocial">Razão Social</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputRazaoSocial"
                  :value="empresa.nome"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputNomeFantasia">Nome Fantasia</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputNomeFantasia"
                  :value="empresa.nome_fantasia"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCep">Cep</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputCep"
                  :value="empresa.cep"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLogradouro">Logradouro</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputLogradouro"
                  :value="empresa.logradouro"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputNumero">Número</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputNumero"
                  :value="empresa.numero"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputTelefone">Telefone</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputTelefone"
                  :value="empresa.telefone"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputEmail"
                  :value="empresa.email"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputComplemento">Complemento</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputComplemento"
                  :value="empresa.complemento"
                  disabled
                />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="inputBairro">Bairro</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputBairro"
                  :value="empresa.bairro"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCidade">Cidade</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputCidade"
                  :value="empresa.cidade"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputSelectsegmentos">Selecione o segmentos</label>
                <select
                  class="form-control"
                  id="inputSelectsegmentos"
                  v-model="segmentos"
                >
                  <option disabled value="">Escolha um item</option>
                  <option value="1">Produto</option>
                  <option value="2">Serviço</option>
                  <option value="3">Produto e Serviço</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputInscricaoMunicipal">Inscrição Municipal</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputInscricaoMunicipal"
                  v-model="inscricao_municipal"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputInscricaoEstadual"
                  >Inscrição Estadual (opcional)</label
                >
                <input
                  type="text"
                  class="form-control"
                  id="inputInscricaoEstadual"
                  v-model="inscricao_estadual"
                />
              </div>
            </div>
          </div>
          <button class="btn btn-success">Salvar Empresa</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  name: "CadEmpresa",
  data() {
    return {
      isLoading: false,
      step: 1,
      cnpj: "",
      show_form: false,
      dados_form: [],
      segmentos: "",
      inscricao_municipal: "",
      inscricao_estadual: "",
      aviso: "Aviso ao enviar",
    };
  },
  components: {
    Loading,
  },
  watch: {
    cnpj(value) {
      if (value.length === 14) {
        this.isLoading = true;
        this.buscaCnpj(value);
      }
    },
    dados_form() {
      this.isLoading = false;
    },
  },
  methods: {
    buscaCnpj(value) {
      axios
        .get(
          `https://cors-anywhere.herokuapp.com/https://www.receitaws.com.br/v1/cnpj/${value}`
        )
        .then((response) => {
          this.dados_form = [];
          this.segmentos = "";
          this.inscricao_municipal = "";
          this.inscricao_estadual = "";
          this.show_form = true;
          this.dados_form.push({
            nome: response.data.nome,
            nome_fantasia:
              response.data.fantasia === ""
                ? "Nenhum nome fantasia registrado"
                : response.data.fantasia,
            cep: response.data.cep,
            logradouro: response.data.logradouro,
            numero: response.data.numero,
            telefone: response.data.telefone,
            email:
              response.data.email === ""
                ? "Nenhum email registrado"
                : response.data.email,
            complemento:
              response.data.complemento === ""
                ? "Nenhum complemento registrado"
                : response.data.complemento,
            bairro: response.data.bairro,
            cidade: response.data.municipio,
            estado: response.data.uf,
          });
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    enviarDados() {
      let forms_value = this.dados_form[0];
      forms_value["cnpj"] = this.cnpj;
      forms_value["segmentos"] = this.segmentos;
      forms_value["inscricao_municipal"] = this.inscricao_municipal;
      forms_value["inscricao_estadual"] = this.inscricao_estadual;
      if (forms_value.segmentos < 1 || forms_value.segmentos == null) {
        this.$bvToast.toast(`Selecione um segmentos`, {
          title: this.aviso,
          autoHideDelay: 5000,
          variant: "warning",
        });
      } else if (
        forms_value.inscricao_municipal == null ||
        forms_value.inscricao_municipal.length < 6
      ) {
        this.$bvToast.toast(`Inscrição Municipal invalida`, {
          title: this.aviso,
          autoHideDelay: 5000,
          variant: "warning",
        });
      } else {
        axios
          .post(
            `${process.env.VUE_APP_ENV_VARIABLE}api/cadastra-empresa`,
            forms_value
          )
          .then((response) => {
            if (response.data.error) {
              this.$bvToast.toast(response.data.error, {
                title: "Erro",
                autoHideDelay: 5000,
                variant: "danger",
              });
            } else {
              this.show_form = false;
              this.cnpj = "";
              this.dados_form = [];
              this.$bvToast.toast(response.data.msg, {
                title: "Cadastrado com sucesso",
                autoHideDelay: 5000,
                variant: "success",
              });
            }
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    },
  },
};
</script>

<style lang="scss">
.cadEmpresa {
  padding-top: 2%;
  height: 90vh;
}
</style>
