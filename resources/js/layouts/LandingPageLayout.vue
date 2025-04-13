<template>
  <v-app>
    <v-main>
        <router-view />
    </v-main>

    <v-footer app>
      <v-col class="text-center" cols="12">
        {{ new Date().getFullYear() }} — powered by <strong>Touch Estate</strong>
      </v-col>
    </v-footer>
  </v-app>
</template>

<script setup lang="ts">
// Component logic here
</script>
