<script setup lang="ts">
import { GoogleMap, AdvancedMarker } from 'vue3-google-map'

const apiKey = import.meta.env['VITE_GOOGLE_MAPS_API_KEY'] as string;

const props = defineProps<{
    center: {
        lat: number;
        lng: number;
    }
    zoom?: number;
}>()

const mapOptions = {
  center: props.center,
  zoom: props.zoom || 15,
  mapTypeControl: false,
  streetViewControl: false,
  fullscreenControl: false,
  zoomControl: true,
  styles: [
    {
      featureType: 'poi',
      elementType: 'labels',
      stylers: [{ visibility: 'off' }]
    }
  ]
}

const markerOptions = {
  position: props.center,
  title: '1110 Samar Crescent #315'
}

const pinOptions = {
  background: '#4285F4',
  borderColor: '#3367D6',
  glyphColor: 'white'
}
</script>

<template>
    <GoogleMap
        :api-key="apiKey"
        mapId="97ebec3af381e1e4"
        style="width: 100%; height: 500px"
        :center="mapOptions.center"
        :zoom="mapOptions.zoom"
    >
        <AdvancedMarker
            :options="markerOptions"
            :pin-options="pinOptions"
        />
    </GoogleMap>
</template>
