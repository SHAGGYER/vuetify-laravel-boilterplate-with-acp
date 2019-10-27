<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="8">
                <h1>Register Form</h1>

                <form @submit.prevent="validatePersonalInformation">
                    <Errors :errors="personalErrors"></Errors>

                    <v-text-field
                            label="Name"
                            type="text"
                            v-model="name"
                    ></v-text-field>

                    <v-text-field
                            label="Login"
                            prepend-icon="person"
                            type="text"
                            v-model="email"
                    ></v-text-field>

                    <v-text-field
                            v-model="password"
                            label="Password"
                            prepend-icon="lock"
                            type="password"
                    ></v-text-field>

                    <v-text-field
                            v-model="passwordAgain"
                            label="Password Again"
                            prepend-icon="lock"
                            type="password"
                    ></v-text-field>

                    <v-btn @click="validatePersonalInformation" color="primary" type="submit">Continue</v-btn>

                </form>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
  import Errors from "../../../common/Errors";
  export default {
    name: "Login",
    components: {Errors},
    data() {
      return {
        email: '',
        password: '',
        passwordAgain: '',
        name: '',
        personalErrors: [],
        step: 1
      }
    },
    methods: {
      validatePersonalInformation() {
        this.personalErrors = [];

        if (!this.name) this.personalErrors.push('Name is required.');
        if (!this.email) this.personalErrors.push('Email is required.');
        if (!this.password) this.personalErrors.push('Password is required');
        if (!this.passwordAgain) this.personalErrors.push('Password confirmation is required');
        else if (this.password !== this.passwordAgain) this.personalErrors.push('Passwords must match');

        if (this.personalErrors.length) return;

        const data = {
          email: this.email,
          password: this.password,
          name: this.name,
        };

        this.$store.dispatch('auth/register', data).then(() => {
          this.$router.push('/');
        }).catch(data => {
          if (data.key === 'email_taken') {
            this.personalErrors.push(data.message);
          }
        });
      }
    }
  }
</script>

<style scoped>

</style>