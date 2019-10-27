<template>
    <v-app>
        <LoadingModal :loading="$store.state.loading"></LoadingModal>
        <v-content v-if="initiated">
            <Install v-if="!$store.state.installed" />
            <Login v-else-if="!$store.state.admin" />
            <v-layout v-else class="fill-height">
                <Sidebar />
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-layout>
        </v-content>
        <notifications />
    </v-app>
</template>

<script>
  import Sidebar from "./components/Sidebar";
  import Login from "./components/auth/Login";
  import Install from './components/auth/Install';
  import LoadingModal from "../common/LoadingModal";
  export default {
    name: "App",
    data() {
      return{
        drawer: true,
        initiated: false
      }
    },
    components: {Login, Install, Sidebar, LoadingModal},
    mounted() {
      this.init();
    },
    methods: {
      init() {
        this.$store.dispatch('auth/init').then(() => {
          this.initiated = true;
        });
      }
    }
  }
</script>

<style scoped>

</style>