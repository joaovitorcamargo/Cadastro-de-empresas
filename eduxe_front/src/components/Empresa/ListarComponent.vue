<template>
  <div>
    <div class="row mt-2">
      <div class="col-md-4" v-for="empresa in empresas.data" :key="empresa.id">
        <div class="card">
          <div class="card-body">
            <p class="card-title"><b>Razão Social:</b> {{ empresa.nome }}</p>
          </div>
          <div class="card-footer">
            <b-link
              :to="{ name: 'InfoEmpresa', params: { id: empresa.id } }"
              class="btn btn-primary"
            >
              Ver
            </b-link>
            <b-link
              :to="{ name: 'EditarEmpresa', params: { id: empresa.id } }"
              class="btn btn-warning"
              >Editar</b-link
            >

            <b-link class="btn btn-danger" @click="excluirEmpresa(empresa.id)"
              >Excluir</b-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["empresas"],
  methods: {
    excluirEmpresa(value) {
      axios
        .post(`${process.env.VUE_APP_ENV_VARIABLE}api/deletar-empresa`, {
          id: value,
        })
        .then(() => {
          this.$bvToast.toast("Excluido com sucesso", {
            title: "Listagem de Empresa",
            autoHideDelay: 5000,
            variant: "success",
          });
          window.location.reload(true);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
      this.$bvModal.hide("bv-modal-example");
    },
  },
};
</script>

<style></style>
