<template>
    <div class="mb-2">
        <v-alert :value="!!errors.length" type="error">
            <ul v-if="errors.length > 1">
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            <span v-else>{{ errors[0] }}</span>
        </v-alert>
    </div>
</template>

<script>
  export default {
    name: "Errors",
    props: ['errors']
  }
</script>

<style scoped>

</style>