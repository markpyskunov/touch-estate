<template>
    <PropertyMobile v-if="isMobile" />
    <PropertyDesktop v-else-if="!isMobile" />
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import PropertyDesktop from './PropertyDesktop.vue'
import PropertyMobile from './PropertyMobile.vue'
import {useLoadingStore} from "@/stores/loading";
import {useVisitStore} from "@/stores/visit";
import {useRoute} from "vue-router";
import {usePropertyMapperStore} from "@/stores/propertyMapper";

const loadingStore = useLoadingStore();
const visitStore = useVisitStore();
const propertyMapperStore = usePropertyMapperStore();
const route = useRoute();

const isMobile = ref(false)

const checkScreenSize = () => {
  isMobile.value = window.innerWidth < 960 // md breakpoint in Vuetify
}

onMounted(async () => {
  checkScreenSize()
  window.addEventListener('resize', checkScreenSize);

    try {
        loadingStore.show('Loading property details...')

        if (!visitStore.property && route.params['id']) {
            await visitStore.fetchPropertyUsingVID(
                route.params['id'] as string,
            );
        }

        propertyMapperStore.injectProperty(visitStore.property!);
    } finally {
        loadingStore.hide()
    }
})

onUnmounted(() => {
  window.removeEventListener('resize', checkScreenSize)
})
</script>
