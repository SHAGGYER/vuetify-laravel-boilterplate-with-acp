<template>
    <div>
        <h1>Profile</h1>

        <v-card v-if="user" class="mt-5">
            <v-card-title>
                {{ user.name }}
            </v-card-title>
            <v-card-text>
                <p>Created At: {{ user.created_at }}</p>
                <p class="mb-0">Email: {{ user.email }}</p>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
  export default {
    name: "Profile",
    data() {
      return {
        user: null
      }
    },
    mounted() {
      this.get();
    },
    methods: {
      get(){
        this.user = this.$store.state.user;
      },
    }
  }
</script>

<style scoped>

</style>