<template>
    <div>
        <h1>Create Admin</h1>
        <v-divider></v-divider>

        <v-form @submit.prevent="valiatePersonalInformation">
            <Errors :errors="personalErrors"></Errors>
            <v-text-field label="Admin's name..." v-model="name"></v-text-field>
            <v-text-field label="Admin's email..." v-model="email"></v-text-field>
            <PasswordGenerator @event="passwordGenerated" size="6" :auto="true"></PasswordGenerator>
            <v-btn type="submit" color="primary">Continue</v-btn>
        </v-form>

    </div>

</template>

<script>
  import Errors from "../../../common/Errors";
  import PasswordGenerator from "../../../common/PasswordGenerator";
  export default {
    name: "CreateAdmin",
    components: {PasswordGenerator, Errors},
    data() {
      return{
        name: '',
        email: '',
        password: '',
        personalErrors: [],
        step: 1,
      }
    },
    methods: {
      passwordGenerated(password) {
        this.password = password;
      },
      valiatePersonalInformation() {
        this.personalErrors = [];

        if (!this.name) this.personalErrors.push('Name is required.');
        if (!this.email) this.personalErrors.push('Email is required');
        else if (!this.$store.state.helpers.validateEmail(this.email)) this.personalErrors.push('Email must be in correct format');
        if (!this.password) this.personalErrors.push('Password is required');

        if (this.personalErrors.length) return;

        const data = {
          name: this.name,
          email: this.email,
          password: this.password,
        };

        this.$store.dispatch('admins/create', data).then(admin => {
          this.$notify('This admin has been created');
          this.$router.push({
            name: 'user',
            params: {
              id: admin.id
            }
          })
        })
      }
    }
  }
</script>

<style scoped>

</style>