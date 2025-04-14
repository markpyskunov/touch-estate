<template>
  <v-container class="py-0 px-4" fluid>
    <!-- Image Slider Section -->
    <div class="mx-n4">
      <v-carousel
        height="500"
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
      max-width="1200"
      flat
      style="border: 1px solid rgba(0,0,0,0.12)"
      :style="{
        borderTopLeftRadius: '0',
        borderTopRightRadius: '0',
        borderBottomLeftRadius: '8px',
        borderBottomRightRadius: '8px'
      }"
    >
      <!-- Main Content Area -->
      <div class="d-flex flex-column">
        <!-- Two Column Layout -->
        <div class="d-flex justify-space-between" style="min-height: 200px">
          <!-- Left Column - Price and Details -->
          <div class="d-flex flex-column">
            <div>
              <div class="text-h3 text-primary font-weight-medium">${{ listing.price }}</div>
              <div class="text-h5 mt-2">{{ listing.address }}</div>
              <div class="text-h6 text-grey">{{ listing.city }}, {{ listing.province }} {{ listing.postalCode }}</div>

              <div class="d-flex align-center mt-2">
                <span class="text-grey me-2">MLS® Number:</span>
                <span>995201</span>
              </div>

              <v-btn
                color="primary"
                variant="text"
                class="px-0 mt-2"
                prepend-icon="mdi-calculator"
              >
                Get Qualified for a Mortgage
                <v-icon size="small" class="ms-1">mdi-information</v-icon>
              </v-btn>
            </div>
          </div>

          <!-- Right Column - Property Stats -->
          <div class="d-flex flex-column justify-space-between">
            <!-- Top Buttons -->
            <div class="d-flex justify-end">
              <v-btn
                variant="outlined"
                density="comfortable"
                class="text-none"
                color="error"
                prepend-icon="mdi-heart-outline"
              >
                Favourite
              </v-btn>
            </div>

            <!-- Bottom Stats -->
            <div class="d-flex justify-space-between" style="width: 100%; gap: 24px;">
              <div class="text-center">
                <v-icon size="28">mdi-bed</v-icon>
                <div class="text-subtitle-1 font-weight-medium">4</div>
                <div class="text-caption text-grey">Bedrooms</div>
              </div>
              <div class="text-center">
                <v-icon size="28">mdi-shower</v-icon>
                <div class="text-subtitle-1 font-weight-medium">3</div>
                <div class="text-caption text-grey">Bathrooms</div>
              </div>
              <div class="text-center">
                <v-icon size="28">mdi-ruler-square</v-icon>
                <div class="text-subtitle-1 font-weight-medium">3033</div>
                <div class="text-caption text-grey">Square Feet</div>
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
          </div>
        </div>
      </div>
    </v-card>

    <!-- Main Content Section -->
    <v-row>
      <!-- Left Column - Property Details -->
      <v-col cols="12" md="8">
        <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
          <v-card-title class="text-h4">{{ listing.title }}</v-card-title>
          <v-card-subtitle class="text-h6">{{ listing.address }}</v-card-subtitle>

          <v-card-text>
            <div class="text-h6 mb-4">Description</div>
            <p class="text-body-1">{{ listing.description }}</p>
          </v-card-text>

          <v-card-text>
            <div class="text-h6 mb-4">Features</div>
            <v-chip
              v-for="(feature, index) in listing.features"
              :key="index"
              class="ma-2"
              color="primary"
              variant="outlined"
            >
              {{ feature }}
            </v-chip>
          </v-card-text>
        </v-card>

        <!-- Additional Images -->
        <v-row class="mb-6">
          <v-col cols="6" v-for="(image, index) in listing.images" :key="index">
            <v-img
              :src="image.url"
              height="200"
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
              <colgroup>
                <col width="120">
                <col width="200">
                <col width="150">
              </colgroup>
              <thead>
                <tr>
                  <th class="text-left" width="120">Level</th>
                  <th class="text-left" width="200">Room</th>
                  <th class="text-left" width="150">Dimensions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="room in rooms" :key="room.id">
                  <td style="width: 120px">
                    <div class="d-flex align-center">
                      <v-icon size="20" class="me-2">{{ getLevelIcon(room.level) }}</v-icon>
                      {{ room.level }}
                    </div>
                  </td>
                  <td style="width: 200px">{{ room.name }}</td>
                  <td style="width: 150px">{{ formatDimensions(room.dimensions) }}</td>
                </tr>
              </tbody>
            </v-table>
          </v-card-text>
        </v-card>
      </v-col>

      <!-- Right Column - Agent Info & Subscribe -->
      <v-col cols="12" md="4">
        <!-- Property Stats Card -->
        <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
          <v-card-text class="py-4">
            <div class="d-flex align-center justify-space-between mb-4">
              <div class="d-flex flex-column align-center justify-center" style="width: 100%">
                <div class="text-h5 font-weight-medium text-primary mb-1">324</div>
                <div class="text-caption text-grey">Views</div>
              </div>
              <v-divider vertical></v-divider>
              <div class="d-flex flex-column align-center justify-center" style="width: 100%">
                <div class="text-h5 font-weight-medium text-error mb-1">45</div>
                <div class="text-caption text-grey">Favorites</div>
              </div>
              <v-divider vertical></v-divider>
              <div class="d-flex flex-column align-center justify-center" style="width: 100%">
                <v-tooltip text="High demand on watching this property" location="bottom">
                  <template v-slot:activator="{ props }">
                    <v-icon
                      v-bind="props"
                      color="warning"
                      size="32"
                      class="mb-1"
                    >
                      mdi-trending-up
                    </v-icon>
                  </template>
                </v-tooltip>
                <div class="text-caption text-grey">Trending</div>
              </div>
            </div>
            <v-divider class="mb-4"></v-divider>
            <div class="d-flex align-center justify-center">
              <v-icon color="warning" class="me-2">mdi-fire</v-icon>
              <span class="text-body-2">High interest in the last 30 days</span>
            </div>
          </v-card-text>
        </v-card>

        <!-- Agent Info Card -->
        <v-card class="sticky-top mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
          <v-card-text class="pt-4">
            <!-- Agent Info -->
            <div class="d-flex align-center mb-6">
              <v-avatar size="80" class="me-4">
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

            <!-- Previous Notes -->
            <div v-if="previousNotes.length > 0" class="mb-6">
              <div class="text-subtitle-1 mb-3">Your Notes</div>
              <v-timeline density="compact" align="start">
                <v-timeline-item
                  v-for="note in previousNotes"
                  :key="note.id"
                  dot-color="primary"
                  size="small"
                >
                  <div class="text-caption text-grey mb-1">{{ formatDate(note.timestamp) }}</div>
                  <div class="text-body-2">{{ note.content }}</div>
                </v-timeline-item>
              </v-timeline>
            </div>

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

            <v-divider class="mb-6"></v-divider>

            <!-- Recent Visits -->
            <div class="d-flex justify-space-between align-center mb-4">
              <div class="text-h6">Your Visits</div>
              <v-chip
                color="primary"
                variant="outlined"
                size="small"
                class="font-weight-regular"
              >
                {{ visits.length }} visits
              </v-chip>
            </div>

            <div class="visits-timeline" style="max-height: 500px; overflow-y: auto;">
              <v-timeline density="compact" align="start">
                <v-timeline-item
                  v-for="visit in visits"
                  :key="visit.id"
                  :dot-color="visit.type === 'nfc' ? 'primary' : visit.type === 'qr' ? 'success' : 'info'"
                  size="small"
                >
                  <div class="text-caption text-grey mb-1">{{ formatVisitDate(visit.timestamp) }}</div>
                  <div class="d-flex align-center">
                    <v-icon
                      size="16"
                      :color="visit.type === 'nfc' ? 'primary' : visit.type === 'qr' ? 'success' : 'info'"
                      class="me-2"
                    >
                      {{ visit.type === 'nfc' ? 'mdi-nfc-variant' :
                         visit.type === 'qr' ? 'mdi-qrcode' :
                         'mdi-web' }}
                    </v-icon>
                    <span class="text-body-2">
                      Visited via {{
                        visit.type === 'nfc' ? 'NFC Tag' :
                        visit.type === 'qr' ? 'QR Code' :
                        'Website'
                      }}
                    </span>
                  </div>
                </v-timeline-item>
              </v-timeline>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <!-- Documents Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="d-flex justify-space-between align-center pa-4">
        Documents
        <v-chip
          color="primary"
          variant="outlined"
          size="small"
          class="font-weight-regular"
        >
          {{ documents.length }} files
        </v-chip>
      </v-card-title>

      <v-card-text>
        <v-list density="compact">
          <v-list-item
            v-for="doc in documents"
            :key="doc.id"
            :href="doc.url"
            target="_blank"
            class="px-2"
          >
            <template v-slot:prepend>
              <v-icon :color="doc.iconColor" size="20" class="me-2">{{ doc.icon }}</v-icon>
            </template>

            <v-list-item-title class="text-body-2">{{ doc.name }}</v-list-item-title>

            <template v-slot:append>
              <v-chip
                size="x-small"
                color="grey"
                variant="flat"
                class="font-weight-regular text-caption"
              >
                {{ doc.size }}
              </v-chip>
            </template>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>

    <!-- Mortgage Calculator -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="d-flex justify-space-between align-center pa-4">
        Mortgage Calculator
        <v-chip
          color="primary"
          variant="outlined"
          size="small"
          class="font-weight-regular"
        >
          Current Rate: {{ calculatorSettings.interestRate }}%
        </v-chip>
      </v-card-title>

      <v-card-text>
        <!-- Calculator Controls -->
        <v-row class="mb-6">
          <v-col cols="12" md="4">
            <div class="text-subtitle-2 mb-2">Down Payment</div>
            <v-slider
              v-model="calculatorSettings.downPayment"
              :min="5"
              :max="50"
              :step="5"
              thumb-label
              :ticks="[10, 20, 30, 40]"
              show-ticks="always"
            >
              <template v-slot:append>
                <v-text-field
                  v-model="calculatorSettings.downPayment"
                  type="number"
                  style="width: 70px"
                  density="compact"
                  hide-details
                  variant="outlined"
                  class="mt-1"
                ></v-text-field>
                <span class="text-body-2 ml-1">%</span>
              </template>
            </v-slider>
          </v-col>

          <v-col cols="12" md="4">
            <div class="text-subtitle-2 mb-2">Interest Rate</div>
            <v-slider
              v-model="calculatorSettings.interestRate"
              :min="1"
              :max="10"
              :step="0.25"
              thumb-label
              :ticks="[2, 4, 6, 8]"
              show-ticks="always"
            >
              <template v-slot:append>
                <v-text-field
                  v-model="calculatorSettings.interestRate"
                  type="number"
                  style="width: 70px"
                  density="compact"
                  hide-details
                  variant="outlined"
                  class="mt-1"
                ></v-text-field>
                <span class="text-body-2 ml-1">%</span>
              </template>
            </v-slider>
          </v-col>

          <v-col cols="12" md="4">
            <div class="text-subtitle-2 mb-2">Amortization</div>
            <v-slider
              v-model="calculatorSettings.amortizationYears"
              :min="5"
              :max="30"
              :step="5"
              thumb-label
              :ticks="[10, 15, 20, 25]"
              show-ticks="always"
            >
              <template v-slot:append>
                <v-text-field
                  v-model="calculatorSettings.amortizationYears"
                  type="number"
                  style="width: 70px"
                  density="compact"
                  hide-details
                  variant="outlined"
                  class="mt-1"
                ></v-text-field>
                <span class="text-body-2 ml-1">yrs</span>
              </template>
            </v-slider>
          </v-col>
        </v-row>

        <!-- Results -->
        <v-row class="d-flex" style="min-height: 200px">
          <v-col cols="12" md="6" class="d-flex">
            <div class="pa-4 bg-grey-lighten-4 rounded d-flex flex-column" style="width: 100%">
              <div class="d-flex justify-space-between mb-2">
                <span class="text-body-2">Property Price</span>
                <span class="text-body-2">${{ listing.price }}</span>
              </div>
              <div class="d-flex justify-space-between mb-2">
                <span class="text-body-2">Down Payment ({{ calculatorSettings.downPayment }}%)</span>
                <span class="text-body-2">${{ calculateDownPayment(calculatorSettings.downPayment) }}</span>
              </div>
              <v-divider class="my-2"></v-divider>
              <div class="d-flex justify-space-between mb-2">
                <span class="text-body-2">Loan Amount</span>
                <span class="text-body-2">${{ calculateLoanAmount(calculatorSettings.downPayment) }}</span>
              </div>
              <div class="d-flex justify-space-between mt-auto">
                <span class="text-body-2">Monthly Payment</span>
                <span class="text-h6 text-primary">${{ calculateMonthlyPayment(calculatorSettings.downPayment) }}</span>
              </div>
            </div>
          </v-col>

          <v-col cols="12" md="6" class="d-flex">
            <div class="pa-4 rounded d-flex flex-column" style="width: 100%; border: 1px solid rgba(0,0,0,0.12)">
              <div class="text-subtitle-1 mb-3">Additional Monthly Costs</div>
              <div class="d-flex justify-space-between mb-2">
                <span class="text-body-2">Property Taxes</span>
                <span class="text-body-2">${{ propertyTaxes }}/month</span>
              </div>
              <div class="d-flex justify-space-between mb-2">
                <div class="d-flex align-center">
                  <span class="text-body-2">Maintenance Fees</span>
                  <v-tooltip text="Building maintenance / Condo fees" location="right">
                    <template v-slot:activator="{ props }">
                      <v-icon
                        v-bind="props"
                        size="16"
                        color="grey"
                        class="ms-1"
                      >
                        mdi-information
                      </v-icon>
                    </template>
                  </v-tooltip>
                </div>
                <span class="text-body-2">${{ maintenanceFees }}/month</span>
              </div>
              <v-divider class="my-2"></v-divider>
              <div class="d-flex justify-space-between mt-auto">
                <span class="text-body-2 font-weight-medium">Total Monthly Cost</span>
                <span class="text-h6 text-primary">${{ calculateTotalMonthlyCost(calculatorSettings.downPayment) }}</span>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>

    <!-- Map Section -->
    <v-row class="mt-6">
      <v-col cols="12">
        <v-card flat style="border: 1px solid rgba(0,0,0,0.12)">
          <v-card-title class="text-h5">Location</v-card-title>
          <v-card-text>
            <div class="map-container">
              <v-card class="map-card">
                <InteractiveMap
                  :center="coordinates"
                  :zoom="15"
                />
              </v-card>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup lang="ts">
import {ref, onMounted} from 'vue'
import { useLoadingStore } from '@/stores/loading'
import InteractiveMap from '@/components/InteractiveMap.vue'

interface SubscribeForm {
  personalNote: string
}

interface Note {
  id: number
  content: string
  timestamp: Date
}

interface RoomDimensions {
  width: number
  length: number
}

interface Room {
  id: number
  level: string
  name: string
  dimensions: RoomDimensions
}

interface Document {
  id: number
  name: string
  url: string
  size: string
  icon: string
  iconColor: string
}

interface Visit {
  id: number
  visitorName: string
  timestamp: Date
  type: 'nfc' | 'qr' | 'website'
}

const listing = ref({
  title: 'Main information',
  price: '1,225,000',
  address: '1110 Samar Cres',
  city: 'Langford',
  province: 'British Columbia',
  postalCode: 'V9B 0A1',
  mainImage: '/images/properties/bathroom.jpg',
  images: [
    { url: '/images/properties/living-room-1.jpg' },
    { url: '/images/properties/kitchen-1.jpg' },
    { url: '/images/properties/bedroom-1.jpg' },
    { url: '/images/properties/bathroom.jpg' }
  ],
  additionalImages: [
    { url: '/images/properties/living-room-2.jpg', title: 'Living Room' },
    { url: '/images/properties/kitchen-2.jpg', title: 'Kitchen' },
    { url: '/images/properties/bedroom-2.jpg', title: 'Bedroom' },
  ],
  description: 'Beautiful family home in the desirable Langford area. This spacious property features 4 bedrooms, 3 bathrooms, and a large backyard perfect for entertaining. The home has been recently updated with modern finishes while maintaining its classic charm.',
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
  bedrooms: 4,
  bathrooms: 3,
  area: 2500,
  mlsNumber: '995201',
})

const subscribeForm = ref<SubscribeForm>({
  personalNote: ''
})

// Combine all images for the carousel
const allImages = ref([
  {
    url: '/images/properties/bathroom.jpg',
    title: 'Front View'
  },
  {
    url: '/images/properties/living-room-1.jpg',
    title: 'Living Room'
  },
  {
    url: '/images/properties/kitchen-1.jpg',
    title: 'Kitchen'
  },
  {
    url: '/images/properties/bedroom-1.jpg',
    title: 'Bedroom'
  },
  {
    url: '/images/properties/bathroom.jpg',
    title: 'Bathroom'
  }
])

// Mock data for previous notes
const previousNotes = ref<Note[]>([
  {
    id: 1,
    content: "Great location, close to schools and parks. Need to check the garage size.",
    timestamp: new Date('2024-03-15T14:30:00')
  },
  {
    id: 2,
    content: "Called agent about the roof age - was replaced in 2020.",
    timestamp: new Date('2024-03-16T09:15:00')
  }
])

const formatDate = (date: Date): string => {
  return new Intl.DateTimeFormat('en-US', {
    month: 'short',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric'
  }).format(date)
}

const subscribeToProperty = () => {
  // We'll get email from Pinia state here
  console.log('Subscription submitted:', subscribeForm.value)
}

const useMetric = ref(true)

const rooms = ref<Room[]>([
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

const formatDimensions = (dimensions: RoomDimensions): string => {
  if (useMetric.value) {
    return `${dimensions.width.toFixed(1)}m × ${dimensions.length.toFixed(1)}m`
  } else {
    // Convert to feet (1m = 3.28084ft)
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

const documents = ref<Document[]>([
  {
    id: 1,
    name: 'Property Disclosure Statement.pdf',
    url: '#',
    size: '2.4 MB',
    icon: 'mdi-file-document-outline',
    iconColor: 'primary'
  },
  {
    id: 2,
    name: 'Floor Plans.pdf',
    url: '#',
    size: '5.1 MB',
    icon: 'mdi-floor-plan',
    iconColor: 'success'
  },
  {
    id: 3,
    name: 'Property Survey.pdf',
    url: '#',
    size: '3.8 MB',
    icon: 'mdi-map-outline',
    iconColor: 'info'
  },
  {
    id: 4,
    name: 'Title Certificate.pdf',
    url: '#',
    size: '1.2 MB',
    icon: 'mdi-certificate-outline',
    iconColor: 'warning'
  }
])

const visits = ref<Visit[]>([
  {
    id: 1,
    visitorName: 'John D.',
    timestamp: new Date('2024-03-20T14:30:00'),
    type: 'nfc'
  },
  {
    id: 2,
    visitorName: 'Sarah M.',
    timestamp: new Date('2024-03-20T11:15:00'),
    type: 'website'
  },
  {
    id: 3,
    visitorName: 'Mike R.',
    timestamp: new Date('2024-03-19T16:45:00'),
    type: 'qr'
  },
  {
    id: 4,
    visitorName: 'Emma L.',
    timestamp: new Date('2024-03-19T13:20:00'),
    type: 'website'
  }
])

const formatVisitDate = (date: Date): string => {
  const now = new Date()
  const diff = now.getTime() - date.getTime()
  const hours = Math.floor(diff / (1000 * 60 * 60))

  if (hours < 24) {
    return `${hours}h ago`
  } else {
    return formatDate(date)
  }
}

const calculatorSettings = ref({
  downPayment: 10,
  interestRate: 4.00,
  amortizationYears: 25
})

const propertyTaxes = 450
const maintenanceFees = 350

const calculateDownPayment = (percentage: number): string => {
  const price = parseFloat(listing.value.price.replace(/,/g, ''))
  return (price * (percentage / 100)).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateLoanAmount = (downPaymentPercentage: number): string => {
  const price = parseFloat(listing.value.price.replace(/,/g, ''))
  const downPayment = price * (downPaymentPercentage / 100)
  return (price - downPayment).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateMonthlyPayment = (downPaymentPercentage: number): string => {
  const price = parseFloat(listing.value.price.replace(/,/g, ''))
  const downPayment = price * (downPaymentPercentage / 100)
  const loanAmount = price - downPayment
  const monthlyRate = calculatorSettings.value.interestRate / 100 / 12
  const numberOfPayments = calculatorSettings.value.amortizationYears * 12

  const monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
                        (Math.pow(1 + monthlyRate, numberOfPayments) - 1)

  return monthlyPayment.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateTotalMonthlyCost = (downPaymentPercentage: number): string => {
  const monthlyPayment = parseFloat(calculateMonthlyPayment(downPaymentPercentage).replace(/,/g, ''))
  const total = monthlyPayment + propertyTaxes + maintenanceFees
  return total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const loadingStore = useLoadingStore()

// Replace the mapImage property with coordinates
const coordinates = { lat: 48.44705905509525, lng: -123.54380246952951 }

onMounted(async () => {
  loadingStore.show('Loading property details...')
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500))
  } finally {
    loadingStore.hide()
  }
})
</script>

<style scoped>
.map-container {
  border-radius: 8px;
  overflow: hidden;
}

.sticky-top {
  position: sticky;
  top: 20px;
}

.thumbnail-item {
  cursor: pointer;
  opacity: 0.7;
  transition: all 0.3s;
}

.thumbnail-item:hover {
  opacity: 1;
}

.thumbnail-active {
  opacity: 1;
  border: 2px solid var(--v-primary-base);
}

:deep(.v-carousel__controls) {
  background: transparent;
}

:deep(.v-carousel__controls__item) {
  color: white;
}

:deep(.v-carousel__controls__item--active) {
  color: var(--v-primary-base);
}

.mt-n8 {
  margin-top: -32px;
}

.visits-timeline {
  scrollbar-width: thin;
  scrollbar-color: rgba(0, 0, 0, 0.2) transparent;
}

.visits-timeline::-webkit-scrollbar {
  width: 6px;
}

.visits-timeline::-webkit-scrollbar-track {
  background: transparent;
}

.visits-timeline::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.2);
  border-radius: 3px;
}
</style>
