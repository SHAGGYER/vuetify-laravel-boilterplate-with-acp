<template>
    <div>
        <h1>View User</h1>

        <div class="mt-5" v-if="user">
            <v-btn @click="goToEdit" color="primary">Edit</v-btn>
            <v-btn @click="confirmDelete" color="error">Delete</v-btn>
        </div>

        <v-card v-if="user" class="mt-5">
            <v-card-title>
                {{ user.name }}
            </v-card-title>
            <v-card-text>
                <p>Created At: {{ user.created_at }}</p>
                <p>Email: {{ user.email }}</p>
            </v-card-text>
        </v-card>
        <v-alert type="info" :value="!user && gotResults">
            {{ error }}
        </v-alert>
    </div>
</template>

<script>
  export default {
    name: "ViewUser",
    data() {
      return {
        user: null,
        error: null,
        gotResults: false
      }
    },
    mounted() {
      this.get();
    },
    methods: {
      get(){
        this.$store.dispatch('users/getById', this.$route.params.id).then(user => {
          this.gotResults = true;
          this.user = user;
        }).catch(message => {
          this.error = message;
          this.gotResults = true;
        })
      },
      goToEdit() {
        this.$router.push({
          name: 'user-edit',
          params: {
            id: this.$route.params.id
          }
        })
      },
      confirmDelete() {
        this.$dialog.confirm('Are you sure?').then(() => {
          this.$store.dispatch('users/delete', this.user.id).then(() => {
            this.$notify('This user has been deleted');

            this.$router.push('/users/browse');
          });
        })
      }
    }
  }
</script>

<style scoped>

</style>