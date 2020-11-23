<template>
  <div class="container">
    <listar-component :unidades="unidades"></listar-component>
  </div>
</template>

<script>
import axios from "axios";
import ListarComponent from "../../components/Unidade/ListarComponent.vue";
export default {
  name: "ListarUnidade",
  data() {
    return {
      unidades: [],
    };
  },
  components: {
    ListarComponent,
  },
  created() {
    axios
      .get(`${process.env.VUE_APP_ENV_VARIABLE}api/listar-unidades`)
      .then((response) => {
        console.log(response.data);
        this.unidades = response.data;
      });
  },
};
</script>

<style></style>
