<template>
  <v-app>
    <router-view></router-view>
    <GlobalLoader />
  </v-app>
</template>

<script setup lang="ts">
import GlobalLoader from '@/components/GlobalLoader.vue'
</script> 