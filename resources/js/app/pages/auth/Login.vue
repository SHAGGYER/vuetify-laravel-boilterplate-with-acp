<template>
    <v-container
            class="fill-height"
            fluid
    >
        <v-row
                align="center"
                justify="center"
        >
            <v-col
                    cols="12"
                    sm="8"
                    md="8"
            >
                <v-card class="elevation-12">
                    <v-toolbar
                            color="primary"
                            dark
                            flat
                    >
                        <v-toolbar-title>Login form</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <form @submit.prevent="onSubmit">
                            <Errors :errors="errors"></Errors>

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
                        </form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="onSubmit" color="primary" type="submit">Login</v-btn>
                    </v-card-actions>
                </v-card>
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
        errors: []
      }
    },
    methods: {
      onSubmit() {
        this.errors = [];

        if (!this.email) this.errors.push('Email is required.');
        if (!this.password) this.errors.push('Password is required');

        if (this.errors.length) return;

        const data = {
          email: this.email,
          password: this.password
        };

        this.$store.dispatch('auth/login', data).then(() => {
          this.$router.push('/');
        }).catch(err => this.errors.push(err));
      }
    }
  }
</script>

<style scoped>

</style>