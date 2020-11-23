<template>
  <div>
    <b-navbar toggleable type="dark" variant="dark">
      <b-navbar-brand to="/">Cad.Empresa</b-navbar-brand>

      <b-navbar-toggle target="navbar-toggle-collapse">
        <template #default="{ expanded }">
          <b-icon v-if="expanded" icon="chevron-bar-up"></b-icon>
          <b-icon v-else icon="chevron-bar-down"></b-icon>
        </template>
      </b-navbar-toggle>

      <b-collapse id="navbar-toggle-collapse" is-nav>
        <b-navbar-nav class="ml-auto">
          <b-nav-item to="/">Home</b-nav-item>
          <b-nav-item to="/cadastrar-empresa">Cadastrar Empresa</b-nav-item>
          <b-nav-item to="/cadastrar-unidade">Cadastrar Unidade</b-nav-item>
          <b-nav-item to="/listar-empresas">Listar Empresas</b-nav-item>
          <b-nav-item to="/listar-unidades">Listar Unidades</b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style></style>
