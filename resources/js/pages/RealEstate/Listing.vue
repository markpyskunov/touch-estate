<template>
  <component :is="isMobile ? ListingMobile : ListingDesktop" />
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import ListingDesktop from './ListingDesktop.vue'
import ListingMobile from './ListingMobile.vue'

const isMobile = ref(false)

const checkScreenSize = () => {
  isMobile.value = window.innerWidth < 960 // md breakpoint in Vuetify
}

onMounted(() => {
  checkScreenSize()
  window.addEventListener('resize', checkScreenSize)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreenSize)
})
</script>