<template>
    <div>
        <h1>View Admin</h1>

        <div class="mt-5" v-if="admin">
            <v-btn @click="goToEdit" :disabled="isRoot && $store.state.admin.id !== admin.id" color="primary">Edit</v-btn>
            <v-btn :disabled="isRoot || $store.state.admin.id === admin.id" @click="confirmDelete" color="error">Delete</v-btn>
        </div>

        <v-card v-if="admin" class="mt-5">
            <v-card-title>
                <span>{{ admin.name }}</span>
                <v-chip class="ml-3" v-if="isRoot">Root</v-chip>
            </v-card-title>
            <v-card-text>
                <p>Created At: {{ admin.created_at }}</p>
                <p>Email: {{ admin.email }}</p>
            </v-card-text>
        </v-card>
        <v-alert type="info" :value="!admin && gotResults">
            {{ error }}
        </v-alert>
    </div>
</template>

<script>
  export default {
    name: "ViewAdmin",
    data() {
      return {
        admin: null,
        error: null,
        gotResults: false
      }
    },
    mounted() {
      this.get();
    },
    computed: {
        isRoot() {
          if (this.admin.root) {
            return true;
          }

          return false;
        }
    },
    methods: {
      get(){
        this.$store.dispatch('admins/getById', this.$route.params.id).then(admin => {
          this.gotResults = true;
          this.admin = admin;
        }).catch(message => {
          this.error = message;
          this.gotResults = true;
        })
      },
      goToEdit() {
        this.$router.push({
          name: 'admin-edit',
          params: {
            id: this.$route.params.id
          }
        })
      },
      confirmDelete() {
        this.$dialog.confirm('Are you sure?').then(() => {
          this.$store.dispatch('admins/delete', this.admin.id).then(() => {
            this.$notify('This admin has been deleted');

            this.$router.push('/admins/browse');
          });
        })
      }
    }
  }
</script>

<style scoped>

</style>