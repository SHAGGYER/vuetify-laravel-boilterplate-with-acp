<template>
    <div>
        <h1>Edit User</h1>
        <v-divider></v-divider>

        <v-card class="mt-5" v-if="user">
            <v-card-text>
                <v-form @submit.prevent="onSubmit">
                    <Errors :errors="errors"></Errors>
                    <v-text-field label="User's name..." v-model="user.name"></v-text-field>
                    <v-text-field label="User's email..." v-model="user.email"></v-text-field>

                    <v-checkbox v-model="changePassword" label="Activate to change password..."></v-checkbox>

                    <PasswordGenerator :disabled="!changePassword" @event="passwordGenerated" size="6"></PasswordGenerator>

                    <v-divider></v-divider>

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
    name: "EditUser",
    components: {PasswordGenerator, Errors},
    data() {
      return{
        errors: [],
        user: null,
        password: '',
        changePassword: false,
      }
    },
    mounted() {
      this.getUser();
    },
    methods: {
      passwordGenerated(password) {
        this.password = password;
      },
      getUser() {
        this.$store.dispatch('users/getById', this.$route.params.id).then(user => {
          this.user = user;
        })
      },
      onSubmit() {
        this.errors = [];

        if (!this.user.name) this.errors.push('Name is required.');
        if (!this.user.email) this.errors.push('Email is required');
        else if (!this.$store.state.helpers.validateEmail(this.user.email)) this.errors.push('Email must be in correct format');

        if (this.errors.length) return;

        const data = {
          name: this.user.name,
          email: this.user.email,
          id: this.user.id
        };

        if (this.password) {
          data.password = this.password;
        }

        this.$store.dispatch('users/update', data).then(() => {
          this.$notify('This user has been updated');

          this.$router.push({
            name: 'user',
            params: {
              id: this.user.id
            }
          })
        })
      }
    }
  }
</script>

<style scoped>

</style>