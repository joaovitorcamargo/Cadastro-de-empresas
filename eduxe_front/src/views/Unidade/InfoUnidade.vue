<template>
  <div>
    <div class="container">
      <div
        class="infos mt-2"
        v-for="unidade in info_unidade"
        :key="unidade.logradouro"
      >
        <h5>Unidade: {{ unidade.logradouro }}</h5>
        <ul>
          <li>Bairro: {{ unidade.bairro }}</li>
          <li>Cep: {{ unidade.cep }}</li>
          <li>Cidade: {{ unidade.localidade }}</li>
          <li>Complemento: {{ unidade.complemento }}</li>
          <li>Numero: {{ unidade.numero }}</li>
          <li>Estado: {{ unidade.estado }}</li>
          <li>
            Empresas que prestam serviço
            <ul v-for="empresa in unidade.empresas" :key="empresa.id">
              <li>
                Razão Social: {{ empresa.nome }} <br />
                Cnpj: {{ empresa.cnpj }} <br />
                Telefone: {{ empresa.telefone }} <br />
                Email: {{ empresa.email }}
              </li>
            </ul>
          </li>
        </ul>
      </div>
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
    };
  },
  created() {
    axios
      .post(`${process.env.VUE_APP_ENV_VARIABLE}api/mostrar-unidade`, {
        id: this.id,
      })
      .then((response) => {
        console.log(response.data);
        let { data } = response.data;
        this.info_unidade.push({ ...data[0], empresas: data[1] });
      })
      .catch((error) => {
        console.log(error.response);
      });
  },
};
</script>

<style></style>
