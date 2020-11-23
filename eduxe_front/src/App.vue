<template>
  <div>
    <loading
      class="background-loading"
      :active.sync="isLoading"
      :can-cancel="false"
      :is-full-page="fullPage"
    >
      <h2 class="title_loading">Carregando...</h2>
    </loading>
    <nav-bar></nav-bar>
    <router-view />
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import NavBar from "./components/NavBar";

export default {
  data() {
    return {
      isLoading: false,
      fullPage: true,
    };
  },
  components: {
    NavBar,
    Loading,
  },
  created() {
    this.onLoading();
  },
  methods: {
    onLoading() {
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
      }, 2500);
    },
  },
};
</script>

<style lang="scss">
.background-loading {
  background-color: #11448b;
  .title_loading {
    color: white;
    animation: 1.5s movimenta infinite;
  }
  @keyframes movimenta {
    0%,
    20%,
    50%,
    80%,
    100% {
      font-size: 3em;
    }
    40% {
      font-size: 3.3em;
    }
    60% {
      font-size: 3.1em;
    }
  }
}
</style>
