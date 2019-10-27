<template>
    <v-navigation-drawer
            class="blue darken-3"
            dark
            permanent
            width="400"
    >
        <v-list>
            <div v-for="(item, index) in items">
                <v-list-item v-if="!item.subItems" link @click="goTo(item.route)">
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-group v-else color="warning" :prepend-icon="item.icon">
                    <template v-slot:activator>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </template>
                    <v-list class="blue darken-4">
                        <v-list-item @click="goTo(subItem.route)" v-for="(subItem,subItemIndex) in item.subItems" :key="subItemIndex">
                            <v-list-item-icon>
                                <v-icon>{{ subItem.icon }}</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>{{ subItem.title }}</v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-list-group>
            </div>
        </v-list>

        <template v-slot:append>
            <div class="pa-2">
                <v-btn block @click="logout">Logout</v-btn>
            </div>
        </template>
    </v-navigation-drawer>
</template>

<script>
  export default {
    name: "Sidebar",
    data () {
      return {
        items: [
          { title: 'Dashboard', icon: 'dashboard', route: '/' },

          {
            title: 'Users',
            icon: 'person',
            subItems: [
              {
                title: 'Create',
                icon: 'create',
                route: '/users/create'
              },
              {
                title: 'Browse',
                icon: 'open_in_browser',
                route: '/users/browse'
              }
            ]
          },

          {
            title: 'Admins',
            icon: 'person',
            subItems: [
              {
                title: 'Create',
                icon: 'create',
                route: '/admins/create'
              },
              {
                title: 'Browse',
                icon: 'open_in_browser',
                route: '/admins/browse'
              }
            ]
          },
          {
            title: 'Settings',
            icon: 'settings',
            route: '/settings'
          }
        ],
      }
    },
    methods: {
      logout() {
        this.$store.dispatch('auth/logout');
      },
      goTo(route) {
        this.$router.push(route).catch(err => {});
      }
    }
  }
</script>

<style scoped>

</style>