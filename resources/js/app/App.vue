<template>
    <v-app>
        <LoadingModal :loading="$store.state.loading"></LoadingModal>
        <Navbar v-if="initiated"></Navbar>
        <v-content v-if="initiated">
            <v-layout class="fill-height">
                <v-container>
                    <router-view></router-view>
                </v-container>
            </v-layout>
        </v-content>
    </v-app>
</template>

<script>
  import LoadingModal from "../common/LoadingModal";
  import Navbar from "./components/Navbar";
  export default {
    name: "App",
    data() {
      return{
        initiated: false
      }
    },
    components: {Navbar, LoadingModal},
    mounted() {
      this.init();
    },
    methods: {
      init() {
        this.$store.dispatch('auth/init').then(isInstalled => {
          this.initiated = true;
          if (!isInstalled) {
            window.location = BASE_URL + '/admin';
            return;
          }
        });
      }
    }
  }
</script>

<style scoped>

</style>