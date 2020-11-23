<template>
  <div class="home d-flex justify-content-center align-items-center">
    <div>
      <h2>Seja Bem-Vindo</h2>
      <div class="mt-2 d-flex justify-content-center flex-column">
        <b-link class="mt-2 btn btn-primary" to="/cadastrar-empresa"
          >Cadastrar Empresa</b-link
        >
        <b-link class="mt-2 btn btn-warning" to="/cadastrar-unidade"
          >Cadastrar Unidade</b-link
        >
        <b-link class="mt-2 btn btn-success" to="/listar-empresas"
          >Ver Empresas</b-link
        >
        <b-link class="mt-2 btn btn-info" to="/listar-unidades"
          >Ver Unidades</b-link
        >
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: "Home",
  components: {},
};
</script>
<style lang="scss" scoped>
.home {
  width: 100%;
  height: 90vh;
}
</style>
