<template>
    <div>
        <h1>Browse Users</h1>
        <v-divider></v-divider>

        <v-card class="mb-3">
            <v-card-text>
                <v-form @submit.prevent="search">
                    <v-text-field v-model="searchQuery" placeholder="Search and press Enter..."></v-text-field>
                </v-form>
            </v-card-text>
        </v-card>

        <v-card v-if="users.length" class="mt-5">
            <v-card-text>
                <v-list>
                    <v-list-item v-for="user in users"
                                 @click="goTo(user.id)"
                                 :key="user.id">
                        <v-list-item-title>{{ user.name }}</v-list-item-title>
                    </v-list-item>
                </v-list>

                <v-pagination
                        v-model="page"
                        :length="lastPage"
                        @input="getUsers"
                        total-visible="10"
                ></v-pagination>
            </v-card-text>
        </v-card>
        <v-alert type="info" :value="!users.length && !!gotResults">
            No users were found.
        </v-alert>
    </div>
</template>

<script>
  export default {
    name: "BrowseUsers",
    data() {
      return {
        users: [],
        gotResults: false,
        searchQuery: '',
        page: 1,
        lastPage: 0
      }
    },
    mounted() {
      this.getUsers();
    },
    methods: {
      search() {
        this.page = 1;
        this.getUsers();
      },
      getUsers() {
        const data = {
          page: this.page,
          searchQuery: this.searchQuery,
          paginate: true
        };

        this.$store.dispatch('users/browse', data).then(response => {
          this.users = response.data;
          this.lastPage = response.last_page;
          this.gotResults = true;
        })
      },
      goTo(id) {
        this.$router.push({
          name: 'user',
          params: {
            id: id
          }
        })
      }
    }
  }
</script>

<style scoped>

</style>