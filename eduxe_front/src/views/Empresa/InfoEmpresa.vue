<template>
  <div>
    <div class="container">
      <div
        class="infos mt-2"
        v-for="empresa in info_empresa"
        :key="empresa.cnpj"
      >
        <h5>{{ empresa.nome }}</h5>
        <ul>
          <li>Cnpj: {{ empresa.cnpj }}</li>
          <li>Nome Fantasia: {{ empresa.nome_fantasia }}</li>
          <li>Cep: {{ empresa.cep }}</li>
          <li>Logradouro: {{ empresa.logradouro }}</li>
          <li>Numero: {{ empresa.numero }}</li>
          <li>Telefone: {{ empresa.telefone }}</li>
          <li>Email: {{ empresa.email }}</li>
          <li>Complemento: {{ empresa.complemento }}</li>
          <li>Bairro: {{ empresa.bairro }}</li>
          <li>Cidade: {{ empresa.cidade }}</li>
          <li>Estado: {{ empresa.estado }}</li>
          <li>Inscricao Municipal: {{ empresa.inscricao_municipal }}</li>
          <li>Inscricao Estadual: {{ empresa.inscricao_estadual }}</li>
          <li>segmentos: {{ empresa.segmentos.tipo }}</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["id"],
  name: "InfoEmpresa",
  data() {
    return {
      info_empresa: [],
    };
  },
  created() {
    axios
      .post(`${process.env.VUE_APP_ENV_VARIABLE}api/mostrar-empresa`, {
        id: this.id,
      })
      .then((response) => {
        let { data } = response.data;
        this.info_empresa.push({ ...data[0], segmentos: data[1] });
      })
      .catch((error) => {
        console.log(error.response);
      });
  },
};
</script>

<style></style>
