<template>
  <div class="d-flex justify-content-center align-items-start">
    <div class="container">
      <form @submit.prevent="editarEmpresa">
        <div v-for="empresa in info_empresa" :key="empresa.id">
          <div class="form-group">
            <label for="inputCnpj">CNPJ</label>
            <the-mask
              type="text"
              class="form-control"
              id="inputCnpj"
              :value="empresa.cnpj"
              placeholder="Digite o CNPJ"
              :mask="['##.###.###/####-##']"
              disabled
            />
          </div>
          <div class="row">
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
            {{ carro }}
          </div>
          <button class="btn btn-success">Editar Empresa</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["id"],
  name: "EditarEmpresa",
  data() {
    return {
      info_empresa: [],
      carro: "",
      segmentos: "",
      inscricao_municipal: "",
      inscricao_estadual: "",
    };
  },
  created() {
    axios
      .post(`${process.env.VUE_APP_ENV_VARIABLE}api/mostrar-empresa`, {
        id: this.id,
      })
      .then((response) => {
        let { data } = response.data;
        this.segmentos = data[1].id;
        this.inscricao_municipal = data[0].inscricao_municipal;
        this.inscricao_estadual = data[0].inscricao_estadual;
        this.info_empresa.push({ ...data[0], segmentos: data[1] });
      })
      .catch((error) => {
        console.log(error.response);
      });
  },
  methods: {
    editarEmpresa() {
      let forms_value = this.info_empresa[0];
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
        delete forms_value.id;
        console.log(forms_value);
        axios
          .post(
            `${process.env.VUE_APP_ENV_VARIABLE}api/editar-empresa`,
            forms_value
          )
          .then(() => {
            this.$bvToast.toast("Editado com sucesso", {
              title: "Formulario de Edição",
              autoHideDelay: 5000,
              variant: "success",
            });
          })
          .catch((error) => {
            this.$bvToast.toast("Houve um erro, tente daqui a pouco", {
              title: "Erro",
              autoHideDelay: 5000,
              variant: "danger",
            });
            console.log(error.response.data);
          });
      }
    },
  },
};
</script>

<style></style>
