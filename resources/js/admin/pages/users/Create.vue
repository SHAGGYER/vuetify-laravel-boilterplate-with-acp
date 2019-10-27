<template>
    <div>
        <h1>Create User</h1>
        <v-divider></v-divider>

        <v-card class="mt-5">
            <v-card-text>
                <v-form @submit.prevent="validatePersonalInformation">
                    <Errors :errors="personalErrors"></Errors>
                    <v-text-field label="User's name..." v-model="name"></v-text-field>
                    <v-text-field label="User's email..." v-model="email"></v-text-field>
                    <PasswordGenerator @event="passwordGenerated" size="6" :auto="true"></PasswordGenerator>
                    <v-btn type="submit" color="primary">Continue</v-btn>
                </v-form>
            </v-card-text>
        </v-card>


    </div>

</template>

<script>
  import Errors from "../../../common/Errors";
  import PasswordGenerator from "../../../common/PasswordGenerator";
  export default {
    name: "CreateUser",
    components: {PasswordGenerator, Errors},
    data() {
      return{
        name: '',
        email: '',
        password: '',
        personalErrors: [],
        step: 1,
        user: null
      }
    },
    methods: {
      passwordGenerated(password) {
        this.password = password;
      },
      viewUser() {
        this.$router.push({
          name: 'user',
          params: {
            id: this.user.id
          }
        })
      },
      newUser() {
        this.name = '';
        this.email = '';
        this.password = '';
        this.step = 1;
      },
      validatePersonalInformation() {
        this.personalErrors = [];

        if (!this.name) this.personalErrors.push('Name is required.');
        if (!this.email) this.personalErrors.push('Email is required');
        else if (!this.$store.state.helpers.validateEmail(this.email)) this.personalErrors.push('Email must be in correct format');
        if (!this.password) this.personalErrors.push('Password is required');

        if (this.personalErrors.length) return;

        this.step = 2;
      }
    }
  }
</script>

<style scoped>

</style>