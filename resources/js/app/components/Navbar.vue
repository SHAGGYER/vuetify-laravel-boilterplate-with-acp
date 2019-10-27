<template>
    <div>
        <v-toolbar>
            <v-toolbar-title>{{ $store.getters['siteTitle'] }}</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items>
                <v-btn text to="/">Home</v-btn>
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-btn text v-on="on">
                            {{ $store.state.user ? $store.state.user.name : 'Account' }}
                        </v-btn>
                    </template>
                    <v-list v-if="$store.state.user">
                        <v-list-item to="/profile">
                            <v-list-item-title>Profile</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="logout">
                            <v-list-item-title>Logout</v-list-item-title>
                        </v-list-item>
                    </v-list>
                    <v-list v-else>
                        <v-list-item to="/auth/login">
                            <v-list-item-title>Login</v-list-item-title>
                        </v-list-item>
                        <v-list-item to="/auth/register">
                            <v-list-item-title>Register</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-toolbar-items>
        </v-toolbar>
    </div>
</template>

<script>
  export default {
    name: "Navbar",
    methods: {
      logout() {
        this.$store.dispatch('auth/logout').then(() => {
          this.$router.push('/').catch(err => {})
        })
      }
    }
  }
</script>

<style scoped>

</style>