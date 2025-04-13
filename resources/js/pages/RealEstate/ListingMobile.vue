<template>
  <v-container class="py-0 px-4" fluid>
    <!-- Image Slider Section -->
    <div class="mx-n4">
      <v-carousel
        height="300"
        cycle
        hide-delimiters
        show-arrows="hover"
      >
        <v-carousel-item
          v-for="(image, index) in allImages"
          :key="index"
          :src="image.url"
          cover
        ></v-carousel-item>
      </v-carousel>
    </div>

    <!-- Price Block -->
    <v-card
      class="mx-auto mt-n8 mb-6 px-4 py-3"
      flat
      style="border: 1px solid rgba(0,0,0,0.12)"
      :style="{
        borderTopLeftRadius: '0',
        borderTopRightRadius: '0',
        borderBottomLeftRadius: '8px',
        borderBottomRightRadius: '8px'
      }"
    >
      <!-- Property Stats -->
      <div class="d-flex justify-space-between mb-4">
        <div class="text-center">
          <v-icon size="28">mdi-bed</v-icon>
          <div class="text-subtitle-1 font-weight-medium">{{ listing.bedrooms }}</div>
          <div class="text-caption text-grey">Bedrooms</div>
        </div>
        <div class="text-center">
          <v-icon size="28">mdi-shower</v-icon>
          <div class="text-subtitle-1 font-weight-medium">{{ listing.bathrooms }}</div>
          <div class="text-caption text-grey">Bathrooms</div>
        </div>
        <div class="text-center">
          <v-icon size="28">mdi-ruler-square</v-icon>
          <div class="text-subtitle-1 font-weight-medium">{{ listing.area }}</div>
          <div class="text-caption text-grey">Sq Ft</div>
        </div>
        <div class="text-center">
          <v-tooltip text="2 Garage + 1 Parking" location="top">
            <template v-slot:activator="{ props }">
              <div v-bind="props">
                <v-icon size="28">mdi-garage</v-icon>
                <div class="text-subtitle-1 font-weight-medium">2+1</div>
                <div class="text-caption text-grey">Parking</div>
              </div>
            </template>
          </v-tooltip>
        </div>
      </div>

      <!-- Price and Favorite -->
      <div class="d-flex justify-space-between align-center mb-4">
        <div class="text-h3 text-primary font-weight-medium">${{ listing.price }}</div>
        <v-btn
          icon
          size="large"
          color="error"
          variant="text"
        >
          <v-icon>mdi-heart-outline</v-icon>
        </v-btn>
      </div>

      <!-- Address Info -->
      <div class="mb-4">
        <div class="text-h6">{{ listing.address }}</div>
        <div class="text-subtitle-1 text-grey">{{ listing.city }}, {{ listing.province }} {{ listing.postalCode }}</div>
        <div class="d-flex align-center mt-2">
          <span class="text-grey me-2">MLS® Number:</span>
          <span>{{ listing.mlsNumber }}</span>
        </div>
      </div>

      <!-- Get Qualified Button -->
      <v-btn
        color="primary"
        block
        class="text-none"
        prepend-icon="mdi-calculator"
      >
        Get Qualified for Mortgage
        <v-icon size="small" class="ms-1">mdi-information</v-icon>
      </v-btn>
    </v-card>

    <!-- Main Content Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5">{{ listing.title }}</v-card-title>
      <v-card-subtitle class="text-h6">{{ listing.address }}</v-card-subtitle>

      <v-card-text>
        <div class="text-h6 mb-4">Description</div>
        <p class="text-body-1">{{ listing.description }}</p>
      </v-card-text>

      <v-card-text>
        <div class="text-h6 mb-4">Features</div>
        <div class="d-flex flex-wrap" style="gap: 8px">
          <v-chip
            v-for="(feature, index) in listing.features"
            :key="index"
            class="ma-1"
            color="primary"
            variant="outlined"
          >
            {{ feature }}
          </v-chip>
        </div>
      </v-card-text>
    </v-card>

    <!-- Additional Images -->
    <v-row class="mb-6">
      <v-col cols="6" v-for="(image, index) in listing.images" :key="index">
        <v-img
          :src="image.url"
          height="150"
          cover
          class="rounded"
        ></v-img>
      </v-col>
    </v-row>

    <!-- Rooms Description -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="d-flex justify-space-between align-center pa-4">
        Rooms
        <div class="d-flex align-center">
          <span
            class="text-caption me-2 d-flex align-center"
            style="line-height: 1"
            :class="!useMetric ? 'text-primary' : 'text-grey'"
          >
            Imperial
          </span>
          <v-switch
            v-model="useMetric"
            hide-details
            density="compact"
            color="primary"
            inset
            class="mt-0 pt-0"
            style="margin-top: -8px !important"
          ></v-switch>
          <span
            class="text-caption ms-2 d-flex align-center"
            style="line-height: 1"
            :class="useMetric ? 'text-primary' : 'text-grey'"
          >
            Metric
          </span>
        </div>
      </v-card-title>

      <v-card-text>
        <v-table density="comfortable">
          <thead>
            <tr>
              <th class="text-left">Level</th>
              <th class="text-left">Room</th>
              <th class="text-left">Dimensions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="room in rooms" :key="room.id">
              <td>
                <div class="d-flex align-center">
                  <v-icon size="20" class="me-2">{{ getLevelIcon(room.level) }}</v-icon>
                  {{ room.level }}
                </div>
              </td>
              <td>{{ room.name }}</td>
              <td>{{ formatDimensions(room.dimensions) }}</td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>

    <!-- Agent Info Card -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-text class="pt-4">
        <!-- Agent Info -->
        <div class="d-flex align-center mb-6">
          <v-avatar size="60" class="me-4">
            <v-img src="https://placehold.co/200x200/333/fff?text=Agent" />
          </v-avatar>
          <div>
            <div class="text-h6">John Smith</div>
            <div class="text-subtitle-2 text-grey">Real Estate Agent</div>
            <div class="mt-2">
              <div class="d-flex align-center mb-1">
                <v-icon size="small" class="me-2">mdi-email</v-icon>
                <a href="mailto:john.smith@realestate.com" class="text-decoration-none">john.smith@realestate.com</a>
              </div>
              <div class="d-flex align-center">
                <v-icon size="small" class="me-2">mdi-phone</v-icon>
                <a href="tel:+12505550123" class="text-decoration-none">+1 (250) 555-0123</a>
              </div>
            </div>
          </div>
        </div>

        <v-divider class="mb-6"></v-divider>

        <!-- Subscribe Form -->
        <div class="text-h6 mb-4">Track This Property</div>
        <p class="text-body-2 mb-4">By subscribing, you'll automatically receive updates about price changes and availability status for this property.</p>

        <v-form @submit.prevent="subscribeToProperty">
          <v-textarea
            v-model="subscribeForm.personalNote"
            label="Add New Note"
            placeholder="Add a note about this property..."
            variant="outlined"
            density="compact"
            rows="2"
            class="mb-4"
            hide-details
          ></v-textarea>

          <v-btn
            color="primary"
            type="submit"
            block
            size="large"
            class="mb-6"
          >
            Subscribe to Updates
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>

    <!-- Map Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5">Location</v-card-title>
      <v-card-text>
        <div class="map-container" style="height: 300px;">
          <v-img
            :src="listing.mapImage"
            height="300"
            cover
          ></v-img>
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'

// Reuse the same interfaces and data from Listing.vue
const route = useRoute()
const listingId = 1

const currentImageIndex = ref(0)

const listing = ref({
  title: 'Main information',
  price: '1,225,000',
  address: '271 Cadillac Ave',
  city: 'Saanich',
  province: 'British Columbia',
  postalCode: 'V8Z1T8',
  mainImage: 'https://placehold.co/1200x500/333/fff?text=Property+Main+Image',
  images: [
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+1' },
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+2' },
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+3' },
  ],
  additionalImages: [
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+4' },
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+5' },
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+6' },
    { url: 'https://placehold.co/600x400/333/fff?text=Property+Image+7' },
  ],
  description: 'Beautiful family home in the desirable Tillicum area. This spacious property features 4 bedrooms, 3 bathrooms, and a large backyard perfect for entertaining. The home has been recently updated with modern finishes while maintaining its classic charm.',
  features: [
    'Modern Kitchen',
    'Hardwood Floors',
    'Fireplace',
    'Central Air',
    'Large Backyard',
    'Updated Bathrooms',
    'Walk-in Closets',
    'Energy Efficient',
  ],
  mapImage: 'https://placehold.co/1200x400/333/fff?text=Property+Location+Map',
  bedrooms: 4,
  bathrooms: 3,
  area: 2500,
  mlsNumber: '995201',
})

const subscribeForm = ref({
  personalNote: ''
})

// Combine all images for the carousel
const allImages = computed(() => [
  { url: listing.value.mainImage },
  ...listing.value.images,
  ...listing.value.additionalImages
])

const subscribeToProperty = () => {
  console.log('Subscription submitted:', subscribeForm.value)
}

const useMetric = ref(true)

const rooms = ref([
  {
    id: 1,
    level: 'Main Floor',
    name: 'Living Room',
    dimensions: { width: 6.1, length: 7.3 }
  },
  {
    id: 2,
    level: 'Main Floor',
    name: 'Kitchen',
    dimensions: { width: 4.2, length: 5.5 }
  },
  {
    id: 3,
    level: 'Main Floor',
    name: 'Dining Room',
    dimensions: { width: 3.9, length: 4.8 }
  },
  {
    id: 4,
    level: 'Upper Floor',
    name: 'Master Bedroom',
    dimensions: { width: 4.5, length: 5.8 }
  },
  {
    id: 5,
    level: 'Upper Floor',
    name: 'Bedroom 2',
    dimensions: { width: 3.6, length: 4.2 }
  },
  {
    id: 6,
    level: 'Upper Floor',
    name: 'Family Bathroom',
    dimensions: { width: 2.8, length: 3.2 }
  },
  {
    id: 7,
    level: 'Third Floor',
    name: 'Bedroom 3',
    dimensions: { width: 3.3, length: 4.0 }
  },
  {
    id: 8,
    level: 'Third Floor',
    name: 'Study Room',
    dimensions: { width: 3.0, length: 3.5 }
  },
  {
    id: 9,
    level: 'Third Floor',
    name: 'Half Bath',
    dimensions: { width: 1.8, length: 2.4 }
  }
])

const formatDimensions = (dimensions: { width: number, length: number }): string => {
  if (useMetric.value) {
    return `${dimensions.width.toFixed(1)}m × ${dimensions.length.toFixed(1)}m`
  } else {
    const widthFt = dimensions.width * 3.28084
    const lengthFt = dimensions.length * 3.28084
    return `${widthFt.toFixed(1)}ft × ${lengthFt.toFixed(1)}ft`
  }
}

const getLevelIcon = (level: string): string => {
  switch (level) {
    case 'Main Floor':
      return 'mdi-home-floor-1'
    case 'Upper Floor':
      return 'mdi-home-floor-2'
    case 'Third Floor':
      return 'mdi-home-floor-3'
    case 'Basement':
      return 'mdi-home-floor-b'
    default:
      return 'mdi-home-floor-1'
  }
}
</script>

<style scoped>
.map-container {
  border-radius: 8px;
  overflow: hidden;
}

.mt-n8 {
  margin-top: -32px;
}
</style> 