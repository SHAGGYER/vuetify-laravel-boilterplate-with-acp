<template>
    <v-container class="fill-height" fluid>
        <v-row align="center"
               justify="center">
            <v-col cols="12"
                   sm="8"
                   md="8">
                <v-stepper v-model="currentStep">
                    <v-stepper-header>
                        <v-stepper-step :complete="currentStep > 1" step="1">Admin Account</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step :complete="currentStep > 2" step="2">App Information</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step step="3">Install</v-stepper-step>

                        <v-divider></v-divider>

                        <v-stepper-step step="4">Finish</v-stepper-step>
                    </v-stepper-header>

                    <v-stepper-items>
                        <v-stepper-content step="1">
                            <v-card>
                                <v-card-text>
                                    <v-form @submit.prevent="validateAdminAccount">
                                        <Errors :errors="adminErrors"></Errors>

                                        <v-text-field v-model="name" placeholder="Name..."></v-text-field>
                                        <v-text-field v-model="email" placeholder="Email..."></v-text-field>
                                        <v-text-field type="password" v-model="password" placeholder="Password..."></v-text-field>
                                        <v-text-field type="password" v-model="passwordAgain" placeholder="Password Again..."></v-text-field>

                                        <v-btn type="submit" color="primary">Continue</v-btn>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-stepper-content>

                        <v-stepper-content step="2">
                            <v-card>
                                <v-card-text>
                                    <v-form @submit.prevent="validateStoreInformation">
                                        <Errors :errors="appErrors"></Errors>

                                        <v-text-field v-model="title" placeholder="Title..."></v-text-field>

                                        <v-btn type="submit" color="primary">Continue</v-btn>
                                    </v-form>
                                </v-card-text>
                            </v-card>
                        </v-stepper-content>

                        <v-stepper-content step="3">
                            <v-alert type="info" :value="true">
                                You are now ready to start the installation. Click Install to continue.
                            </v-alert>

                            <v-btn
                                    color="primary"
                                    @click="install"
                            >
                                Install
                            </v-btn>

                        </v-stepper-content>
                        <v-stepper-content step="4">
                            <v-alert type="success" :value="true">
                                You have successfully installed your store.
                            </v-alert>

                            <v-btn color="primary" @click="finish">
                                Continue
                            </v-btn>
                        </v-stepper-content>
                    </v-stepper-items>
                </v-stepper>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
  import Errors from "../../../common/Errors";
  export default {
    name: "Install",
    components: {Errors},
    data() {
      return {
        currentStep: 1,
        adminErrors: [],
        name: '',
        email: '',
        password: '',
        passwordAgain: '',
        appErrors: [],
        title: '',
        paypalSandboxKey: ''
      }
    },
    methods: {
      validateAdminAccount() {
        this.adminErrors = [];

        if (!this.name) this.adminErrors.push('Name is required.');
        if (!this.email) this.adminErrors.push('Email is required');
        else if (!this.$store.state.helpers.validateEmail(this.email)) this.adminErrors.push('Email must be in correct format');
        if (!this.password) this.adminErrors.push('Password is required');
        if (!this.passwordAgain) this.adminErrors.push('Password confirmation is required');
        else if (this.password !== this.passwordAgain) this.adminErrors.push('Passwords must match.');

        if (this.adminErrors.length) return;

        this.currentStep = 2;
      },
      validateStoreInformation() {
        this.adminErrors = [];

        if (!this.title) this.adminErrors.push('Title is required...');

        if (this.adminErrors.length) return;

        this.currentStep = 3;
      },
      install() {
        const data = {
          name: this.name,
          email: this.email,
          password: this.password,
          title: this.title,
        };
        this.$store.dispatch('auth/install', data).then(() => {
          this.currentStep = 4;
        })
      },
      finish() {
        this.$store.commit('setInstalled', true);
      }
    }
  }
</script>

<style scoped>

</style>