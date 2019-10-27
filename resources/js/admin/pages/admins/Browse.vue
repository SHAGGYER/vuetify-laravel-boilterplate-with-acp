<template>
    <div>
        <h1>Browse Admins</h1>
        <v-divider></v-divider>

        <v-card class="mb-3">
            <v-card-text>
                <v-form @submit.prevent="search">
                    <v-text-field v-model="searchQuery" placeholder="Search and press Enter..."></v-text-field>
                </v-form>
            </v-card-text>
        </v-card>

        <v-card v-if="admins.length" class="mt-5">
            <v-card-text>
                <v-list>
                    <v-list-item v-for="admin in admins"
                                 @click="goTo(admin.id)"
                                 :key="admin.id">
                        <v-list-item-title>{{ admin.name }}</v-list-item-title>
                    </v-list-item>
                </v-list>

                <v-pagination
                        v-model="page"
                        :length="lastPage"
                        @input="getAdmins"
                        total-visible="10"
                ></v-pagination>
            </v-card-text>
        </v-card>
        <v-alert type="info" :value="!admins.length && !!gotResults">
            No admins were found.
        </v-alert>
    </div>
</template>

<script>
  export default {
    name: "BrowseAdmins",
    data() {
      return {
        admins: [],
        gotResults: false,
        searchQuery: '',
        page: 1,
        lastPage: 0
      }
    },
    mounted() {
      this.getAdmins();
    },
    methods: {
      search() {
        this.page = 1;
        this.getAdmins();
      },
      getAdmins() {
        const data = {
          page: this.page,
          searchQuery: this.searchQuery,
          paginate: true
        };

        this.$store.dispatch('admins/browse', data).then(response => {
          this.admins = response.data;
          this.lastPage = response.last_page;
          this.gotResults = true;
        })
      },
      goTo(id) {
        this.$router.push({
          name: 'admin',
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