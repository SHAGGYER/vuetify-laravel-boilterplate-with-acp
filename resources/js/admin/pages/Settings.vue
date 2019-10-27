<template>
    <div>
        <h1>Settings</h1>
        <v-btn color="primary" @click="populateDatabaseWithTestData">Populate Database With Test Data</v-btn>
        <v-btn color="error" @click="emptyDatabase">Empty Database</v-btn>
        <v-card class="mt-5" v-if="settings.length">
            <v-card-title>
                All settings
            </v-card-title>
            <v-card-text>
                <v-form @submit.prevent="save">
                    <v-list>
                        <v-list-item
                                v-for="setting in settings"
                                :key="setting.id">
                            <v-list-item-content>
                                <v-list-item-title v-text="setting.title"></v-list-item-title>
                                <v-list-item-subtitle v-text="setting.description"></v-list-item-subtitle>
                                <v-text-field v-if="setting.type === 'input'"
                                              v-model="setting.value"
                                              :label="setting.title"></v-text-field>
                                <v-checkbox v-else-if="setting.type === 'checkbox'"
                                            v-model="setting.value"
                                            :label="setting.title"></v-checkbox>
                                <v-select v-else-if="setting.type === 'select'" v-model="setting.value"
                                          :items="JSON.parse(setting.options)"
                                          item-value="key"
                                          item-text="text"></v-select>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                    <v-btn type="submit" color="success">Save</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
  export default {
    name: "Settings",
    data() {
      return {
        settings: [],
        gotResults: false
      }
    },
    mounted(){
      this.getSettings();
    },
    methods: {
      populateDatabaseWithTestData() {
        this.$dialog.confirm('Are you sure?').then(() => {
          this.$store.dispatch('settings/populateDatabaseWithTestData').then(() => {
            this.$notify('Database has been populated with test data');
          });
        })
      },
      emptyDatabase() {
        this.$dialog.confirm('Are you sure?').then(() => {
          this.$store.dispatch('settings/emptyDatabase').then(() => {
            this.$notify('Database has been emptied');
          });
        })
      },
      getSettings() {
        this.settings = this.$store.state.settings;
        this.settings.forEach(setting => {
          if (setting.type === 'checkbox') {
            if (setting.value == 0) {
              setting.value = false
            } else {
              setting.value = true;
            }
          }
        })
      },
      save() {
        this.$store.dispatch('settings/save', {settings: this.settings}).then(() => {
          this.$notify('Settings have been updated');
        });
      }
    }
  }
</script>

<style scoped>

</style>