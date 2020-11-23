<template>
  <div class="cadEmpresa d-flex justify-content-center align-items-start">
    <div class="container">
      <form @submit.prevent="editarUnidade">
        <div v-for="unidade in info_unidade" :key="unidade.id">
          <div class="form-group">
            <label for="inputCnpj">CEP</label>
            <the-mask
              type="text"
              class="form-control"
              id="inputCnpj"
              :value="unidade.cep"
              placeholder="Digite o CEP"
              :mask="['#####-###']"
              disabled
            />
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLogradouro">Logradouro</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputLogradouro"
                  :value="unidade.logradouro"
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
                  v-model="complemento"
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
                  :value="unidade.bairro"
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
                  :value="unidade.localidade"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputNumero">Número</label>
                <input
                  type="number"
                  class="form-control"
                  id="inputNumero"
                  v-model="numero"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEstado">Estado</label>
                <input
                  type="text"
                  class="form-control"
                  id="inputEstado"
                  v-model="uf"
                  disabled
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputSelectEmpresa"
                  >Selecione a empresa de atuação principal</label
                >
                <select
                  class="form-control"
                  id="inputSelectEmpresa"
                  v-model="primaria"
                >
                  <option disabled value="">Selecione uma Empresa</option>
                  <option
                    v-for="empresa_primaria in unidade.empresas"
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
                  >Selecione a empresa de atuação secundaria</label
                >
                <select
                  class="form-control"
                  id="inputSelectEmpresa"
                  v-model="secundaria"
                >
                  <option disabled value="">Selecione uma Empresa</option>
                  <option
                    v-for="empresa_secundaria in unidade.empresas"
                    :key="empresa_secundaria.id"
                    :value="empresa_secundaria.id"
                    >{{ empresa_secundaria.nome }}</option
                  >
                </select>
              </div>
            </div>
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
  data() {
    return {
      info_unidade: [],
      primaria: "",
      secundaria: "",
      complemento: "",
      numero: "",
      uf: "",
    };
  },
  created() {
    axios
      .post(`${process.env.VUE_APP_ENV_VARIABLE}api/mostrar-unidade`, {
        id: this.id,
      })
      .then((response) => {
        let { data } = response.data;
        this.primaria = data[1][0].id;
        this.secundaria = data[1][1].id;
        this.numero = data[0].numero;
        this.complemento = data[0].complemento;
        this.uf = data[0].estado;
        this.info_unidade.push({
          ...data[0],
          uf: data[0].estado,
          primaria: data[1][0],
          secundaria: data[1][1],
          numero: data[0].numero,
          complemento: data[0].complemento,
        });
      })
      .catch((error) => {
        console.log(error.response);
      });
  },
  methods: {
    editarUnidade() {
      let forms_value = this.info_unidade[0];
      delete forms_value.primaria;
      delete forms_value.secundaria;
      delete forms_value.numero;
      delete forms_value.complemento;
      delete forms_value.estado;
      forms_value["primaria"] = this.primaria;
      forms_value["uf"] = this.uf;
      forms_value["numero"] = this.numero;
      forms_value["complemento"] = this.complemento;
      forms_value["secundaria"] = this.secundaria;
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
            `${process.env.VUE_APP_ENV_VARIABLE}api/editar-unidade`,
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
