<template>
  <v-overlay
    v-model="loadingStore.isLoading"
    class="d-flex align-center justify-center"
    persistent
    :scrim="false"
    style="height: 100vh; width: 100vw; position: fixed; top: 0; left: 0; background-color: rgb(var(--v-theme-secondary));"
  >
    <div class="d-flex flex-column align-center">
      <v-progress-circular
        color="white"
        indeterminate
        size="64"
        width="4"
      ></v-progress-circular>
      <div class="text-h6 mt-4 text-white">
        {{ loadingStore.loadingMessage }}
      </div>
    </div>
  </v-overlay>
</template>

<script setup lang="ts">
import { useLoadingStore } from '@/stores/loading'

const loadingStore = useLoadingStore()
</script>

<style scoped>
.v-overlay {
  z-index: 9999;
  opacity: 1 !important;
}
</style>
