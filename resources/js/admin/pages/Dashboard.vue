<template>
    <div>
        <h1>Hello {{ $store.state.admin.name }}</h1>

        <v-row>
            <v-col lg="3" sm="4" v-for="item in items" :key="item.title">
                <v-card>
                    <v-card-title>
                        {{ item.title }}
                    </v-card-title>
                    <v-card-text>
                        {{ item.count }}
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
  export default {
    name: "Dashboard",
    data() {
      return {
        items: []
      }
    },
    mounted() {
      this.getDashboardData();
    },
    methods: {
      getDashboardData() {
        this.$store.dispatch('getDashboardData').then(response => {
          this.items = response;
        });
      }
    }
  }
</script>

<style scoped>
</style>