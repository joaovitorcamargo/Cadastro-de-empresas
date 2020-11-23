<template>
  <div>
    <div class="row mt-2">
      <div class="col-md-4" v-for="unidade in unidades.data" :key="unidade.id">
        <div class="card">
          <div class="card-body">
            <p class="card-title">
              <b>Logradouro:</b> {{ unidade.logradouro }}
            </p>
            <p class="card-title"><b>Cep:</b> {{ unidade.cep }}</p>
          </div>
          <div class="card-footer">
            <b-link
              :to="{ name: 'InfoUnidade', params: { id: unidade.id } }"
              class="btn btn-primary"
            >
              Ver
            </b-link>
            <b-link
              :to="{ name: 'EditarUnidade', params: { id: unidade.id } }"
              class="btn btn-warning"
              >Editar</b-link
            >

            <b-link class="btn btn-danger" @click="excluirUnidade(unidade.id)"
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
  props: ["unidades"],
  data() {
    return {};
  },
  methods: {
    excluirUnidade(value) {
      axios
        .post(`${process.env.VUE_APP_ENV_VARIABLE}api/deletar-unidade`, {
          id: value,
        })
        .then(() => {
          this.$bvToast.toast("Excluido com sucesso", {
            title: "Listagem de unidade",
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
