<template>
    <v-overlay :value="loading">
        <v-card color="primary" dark width="300">
            <v-card-text>
                Please stand by
                <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
            </v-card-text>
        </v-card>
    </v-overlay>
</template>

<script>
  export default {
    name: "LoadingModal",
    props: ['loading']
  }
</script>

<style scoped>

</style>