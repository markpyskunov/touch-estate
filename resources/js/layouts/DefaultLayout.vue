<template>
  <v-app>
    <v-app-bar>
      <v-app-bar-title>Real Estate App</v-app-bar-title>
      <v-spacer></v-spacer>
      <v-btn to="/" text>Home</v-btn>
      <v-btn to="/about" text>About</v-btn>
      <v-btn to="/listing" text>View Listing</v-btn>
    </v-app-bar>

    <v-main>
      <v-container>
        <router-view></router-view>
      </v-container>
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
