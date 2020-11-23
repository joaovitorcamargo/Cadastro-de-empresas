<template>
  <div class="cadEmpresa d-flex justify-content-center align-items-start">
    <loading
      class="background-loading"
      :active.sync="isLoading"
      :can-cancel="false"
    >
      <h2 class="title_loading">Carregando...</h2>
    </loading>
    <div class="container">
      <form @submit.prevent="cadastrarUnidade">
        <div class="form-group">
          <label for="inputCnpj">CEP</label>
          <the-mask
            v-model="cep"
            type="text"
            class="form-control"
            id="inputCnpj"
            placeholder="Digite o CEP"
            :mask="['#####-###']"
          />
        </div>
        <div v-show="show_form">
          <div
            class="row"
            v-for="(endereco, index) in form_response"
            :key="index + endereco.cep"
          >
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLogradouro">Logradouro</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputLogradouro"
                  :value="endereco.logradouro"
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
                  v-model="endereco.complemento"
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
                  :value="endereco.bairro"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLocalidade">Localidade</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputLocalidade"
                  :value="endereco.localidade"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLogradouro">Numero</label>
                <input
                  type="number"
                  class="form-control"
                  id="inputLogradouro"
                  v-model="numero"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLogradouro">Estado</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputLogradouro"
                  :value="endereco.uf"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputSelectEmpresa"
                  >Selecione a empresa de autação principal</label
                >
                <select
                  class="form-control"
                  id="inputSelectEmpresa"
                  v-model="primaria"
                >
                  <option disabled value="">Selecione uma Empresa</option>
                  <option
                    v-for="empresa_primaria in empresas"
                    :key="empresa_primaria.id"
                    :value="empresa_primaria.id"
                    >{{ empresa_primaria.nome }}</option
                  >
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputSelectEmpresa"
                  >Selecione a empresa de autação principal</label
                >
                <select
                  class="form-control"
                  id="inputSelectEmpresa"
                  v-model="secundaria"
                >
                  <option disabled value="">Selecione uma Empresa</option>
                  <option
                    v-for="empresa_secundaria in empresas"
                    :key="empresa_secundaria.id"
                    :value="empresa_secundaria.id"
                    >{{ empresa_secundaria.nome }}</option
                  >
                </select>
              </div>
            </div>
          </div>
          <button class="btn btn-success">Salvar Unidade</button>
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
  name: "CadUnidade",
  data() {
    return {
      isLoading: false,
      cep: "",
      show_form: false,
      form_response: [],
      empresas: [],
      primaria: "",
      secundaria: "",
      complemento: "",
      numero: "",
      aviso: "Unidade Aviso",
    };
  },
  components: {
    Loading,
  },
  watch: {
    cep(value) {
      if (value.length === 8) {
        this.isLoading = true;
        this.buscaCep(value);
        this.listarEmpresa();
      }
    },
    form_response() {
      this.isLoading = false;
    },
  },
  methods: {
    buscaCep(value) {
      console.log(`${process.env.VUE_APP_ENV_VARIABLE}`);
      this.primaria = "";
      this.secundaria = "";
      this.numero = "";
      this.complemento = "";
      axios
        .get(`https://viacep.com.br/ws/${value}/json/`)
        .then((response) => {
          this.form_response = [];
          this.form_response.push({ ...response.data });
          this.show_form = true;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    listarEmpresa() {
      axios
        .get(`${process.env.VUE_APP_ENV_VARIABLE}api/listar-empresas`)
        .then((response) => {
          this.empresas = response.data.data;
        });
    },
    cadastrarUnidade() {
      let forms_value = this.form_response[0];
      delete forms_value.ibge;
      delete forms_value.ddd;
      delete forms_value.gia;
      delete forms_value.siafi;
      delete forms_value.cep;
      forms_value["cep"] = this.cep;
      forms_value["primaria"] = this.primaria;
      forms_value["secundaria"] = this.secundaria;
      forms_value["numero"] = this.numero;
      if (forms_value.numero < 1 || forms_value.numero == null) {
        this.$bvToast.toast(`Campo numero é necessário`, {
          title: this.aviso,
          autoHideDelay: 5000,
          variant: "warning",
        });
      } else if (
        forms_value.primaria == forms_value.secundaria ||
        forms_value.secundaria == forms_value.primaria
      ) {
        this.$bvToast.toast(`O campo de empresa não pode ser igual`, {
          title: this.aviso,
          autoHideDelay: 5000,
          variant: "warning",
        });
      } else if (forms_value.primaria == "" || forms_value.secundaria == "") {
        this.$bvToast.toast(`Não tem empresas o suficiente para cadastrar`, {
          title: this.aviso,
          autoHideDelay: 5000,
          variant: "warning",
        });
      } else {
        axios
          .post(
            `${process.env.VUE_APP_ENV_VARIABLE}api/cadastra-unidade`,
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
              this.cep = "";
              this.form_response = [];
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

<style></style>
