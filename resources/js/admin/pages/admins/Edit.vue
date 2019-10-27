<template>
    <div>
        <h1>Edit Admin</h1>
        <v-divider></v-divider>

        <v-card class="mt-5" v-if="admin">
            <v-card-text>
                <v-form @submit.prevent="onSubmit">
                    <Errors :errors="errors"></Errors>
                    <v-text-field label="Admin's name..." v-model="admin.name"></v-text-field>
                    <v-text-field label="Admin's email..." v-model="admin.email"></v-text-field>

                    <v-checkbox v-model="changePassword" label="Activate to change password..."></v-checkbox>

                    <PasswordGenerator :disabled="!changePassword" @event="passwordGenerated" size="6"></PasswordGenerator>

                    <v-btn type="submit" color="success">Save</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>

</template>

<script>
  import Errors from "../../../common/Errors";
  import PasswordGenerator from "../../../common/PasswordGenerator";
  export default {
    name: "EditAdmin",
    components: {PasswordGenerator, Errors},
    data() {
      return{
        errors: [],
        admin: null,
        password: '',
        changePassword: false,
      }
    },
    mounted() {
      this.getAdmin();
    },
    methods: {
      passwordGenerated(password) {
        this.password = password;
      },
      getAdmin() {
        this.$store.dispatch('admins/getById', this.$route.params.id).then(admin => {
          this.admin = admin;

          if (this.admin.root && this.admin.id !== this.$store.state.admin.id) {
            this.$router.push('/admins/browse');
          }
        })
      },
      onSubmit() {
        this.errors = [];

        if (!this.admin.name) this.errors.push('Name is required.');
        if (!this.admin.email) this.errors.push('Email is required');
        else if (!this.$store.state.helpers.validateEmail(this.admin.email)) this.errors.push('Email must be in correct format');

        if (this.errors.length) return;

        const data = {
          name: this.admin.name,
          email: this.admin.email,
          id: this.admin.id
        };

        if (this.password) {
          data.password = this.password;
        }

        this.$store.dispatch('admins/update', data).then(() => {
          this.$notify('This admin has been updated');

          this.$router.push({
            name: 'admin',
            params: {
              id: this.admin.id
            }
          })
        })
      }
    }
  }
</script>

<style scoped>

</style>