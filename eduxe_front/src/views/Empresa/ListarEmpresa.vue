<template>
  <div>
    <div class="container">
      <listar-component :empresas="empresas"></listar-component>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import ListarComponent from "../../components/Empresa/ListarComponent.vue";
export default {
  name: "ListarEmpresa",
  data() {
    return {
      empresas: [],
    };
  },
  components: {
    ListarComponent,
  },
  created() {
    axios
      .get(`${process.env.VUE_APP_ENV_VARIABLE}api/listar-empresas`)
      .then((response) => {
        this.empresas = response.data;
      });
  },
};
</script>

<style lang="scss">
.col-md-4 {
  margin-top: 2%;
  .card {
    height: 180px;
    .btn {
      margin: 1%;
    }
  }
}
</style>
