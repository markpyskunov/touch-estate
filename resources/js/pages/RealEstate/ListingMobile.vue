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

      <!-- Primary CTA -->
      <v-btn
        color="primary"
        block
        size="large"
        class="text-none mb-3"
        elevation="2"
        @click="openSubscribeDialog"
      >
        Subscribe to Updates
      </v-btn>

      <!-- Secondary CTA -->
      <v-btn
        variant="text"
        block
        class="text-none"
        prepend-icon="mdi-calculator"
        color="primary"
      >
        Get Qualified for Mortgage
        <v-icon size="small" class="ms-1">mdi-information</v-icon>
      </v-btn>
    </v-card>

    <!-- Agent Info Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-text class="pt-4">
        <!-- Agent Info -->
        <div class="d-flex align-center">
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
      </v-card-text>
    </v-card>

    <!-- Subscribe Dialog -->
    <v-dialog v-model="showSubscribeDialog" width="100%" fullscreen>
      <v-card>
        <v-toolbar color="primary">
          <v-btn icon @click="showSubscribeDialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Subscribe to Updates</v-toolbar-title>
        </v-toolbar>

        <v-card-text class="pa-4">
          <p class="text-body-1 mb-4">By subscribing, you'll automatically receive updates about price changes and availability status for this property.</p>

          <v-form @submit.prevent="subscribeToProperty">
            <v-textarea
              v-model="subscribeForm.personalNote"
              label="Add New Note"
              placeholder="Add a note about this property..."
              variant="outlined"
              density="comfortable"
              rows="3"
              class="mb-4"
              hide-details
            ></v-textarea>

            <v-btn
              color="primary"
              type="submit"
              block
              size="large"
              class="text-none"
              elevation="2"
            >
              Subscribe to Updates
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

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

    <!-- Notes Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-text>
        <!-- Previous Notes -->
        <div v-if="previousNotes.length > 0" class="mb-6">
          <div class="text-h6 mb-3">Your Notes</div>
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

        <!-- Add Note Form -->
        <div class="text-h6 mb-4">Add Note</div>
        <v-form @submit.prevent="addNote">
          <v-textarea
            v-model="noteForm.content"
            placeholder="Add a note about this property..."
            variant="outlined"
            density="comfortable"
            rows="3"
            class="mb-4"
            hide-details
          ></v-textarea>

          <v-btn
            color="primary"
            type="submit"
            block
            class="text-none"
          >
            Save Note
          </v-btn>
        </v-form>
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
              <th class="text-left" style="width: 48px">Level</th>
              <th class="text-left">Room</th>
              <th class="text-left" style="width: 96px">Dimensions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="room in rooms" :key="room.id">
              <td>
                <v-icon size="20" :title="room.level">{{ getLevelIcon(room.level) }}</v-icon>
              </td>
              <td>
                <v-tooltip :text="room.name" location="top">
                  <template v-slot:activator="{ props }">
                    <div 
                      v-bind="props" 
                      class="text-truncate"
                      style="max-width: 150px"
                    >
                      {{ room.name }}
                    </div>
                  </template>
                </v-tooltip>
              </td>
              <td class="text-no-wrap">{{ formatDimensions(room.dimensions) }}</td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>

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
          Rate: {{ calculatorSettings.interestRate.toFixed(2) }}%
        </v-chip>
      </v-card-title>

      <v-card-text>
        <!-- Down Payment Slider -->
        <div class="mb-6">
          <div class="d-flex justify-space-between align-center mb-2">
            <span class="text-subtitle-2">Down Payment</span>
            <span class="text-subtitle-2">${{ formatPrice(calculateDownPayment()) }}</span>
          </div>
          <v-slider
            v-model="calculatorSettings.downPaymentPercent"
            :min="5"
            :max="20"
            :step="5"
            show-ticks
            :ticks="[5, 10, 15, 20]"
            thumb-label
          >
            <template v-slot:append>
              <span class="text-body-2">{{ calculatorSettings.downPaymentPercent }}%</span>
            </template>
          </v-slider>
        </div>

        <!-- Interest Rate Slider -->
        <div class="mb-6">
          <div class="d-flex justify-space-between align-center mb-2">
            <span class="text-subtitle-2">Interest Rate</span>
            <span class="text-subtitle-2">{{ calculatorSettings.interestRate.toFixed(2) }}%</span>
          </div>
          <v-slider
            v-model="calculatorSettings.interestRate"
            :min="1"
            :max="10"
            :step="0.25"
            show-ticks
            :ticks="[2, 4, 6, 8]"
            thumb-label
          >
            <template v-slot:append>
              <span class="text-body-2">{{ calculatorSettings.interestRate.toFixed(2) }}%</span>
            </template>
          </v-slider>
        </div>

        <!-- Results -->
        <div class="bg-grey-lighten-4 rounded mb-4">
          <!-- Loan Amount -->
          <div class="d-flex align-center px-4 py-3">
            <div class="d-flex align-center">
              <v-icon color="primary" size="small" class="me-3">mdi-bank</v-icon>
              <span>Loan Amount</span>
            </div>
            <v-spacer></v-spacer>
            <span>${{ formatPrice(calculateLoanAmount()) }}</span>
          </div>

          <!-- Monthly Payment -->
          <div class="d-flex align-center px-4 py-3">
            <div class="d-flex align-center">
              <v-icon color="primary" size="small" class="me-3">mdi-calendar-month</v-icon>
              <span>Monthly Payment</span>
            </div>
            <v-spacer></v-spacer>
            <span class="text-primary font-weight-bold">${{ formatPrice(calculateMonthlyPayment()) }}</span>
          </div>

          <!-- Property Tax -->
          <div class="d-flex align-center px-4 py-3">
            <div class="d-flex align-center">
              <v-icon color="primary" size="small" class="me-3">mdi-home-city</v-icon>
              <span>Property Tax</span>
            </div>
            <v-spacer></v-spacer>
            <span>$450/month</span>
          </div>

          <!-- Maintenance -->
          <div class="d-flex align-center px-4 py-3">
            <div class="d-flex align-center">
              <v-icon color="primary" size="small" class="me-3">mdi-hammer-wrench</v-icon>
              <span>Maintenance</span>
            </div>
            <v-spacer></v-spacer>
            <span>$350/month</span>
          </div>

          <v-divider></v-divider>

          <!-- Total Monthly -->
          <div class="d-flex align-center px-4 py-3">
            <div class="d-flex align-center">
              <v-icon color="primary" size="small" class="me-3">mdi-cash-multiple</v-icon>
              <span class="font-weight-medium">Total Monthly</span>
            </div>
            <v-spacer></v-spacer>
            <span class="text-primary font-weight-bold">${{ formatPrice(calculateTotalMonthly()) }}</span>
          </div>
        </div>

        <div class="text-caption text-grey">
          * Based on {{ calculatorSettings.amortizationYears }} year amortization
        </div>
      </v-card-text>
    </v-card>

    <!-- Map Section -->
    <div class="mx-n4">
      <v-img
        :src="listing.mapImage"
        height="300"
        cover
      ></v-img>
    </div>
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

interface Note {
  id: number
  content: string
  timestamp: Date
}

const noteForm = ref({
  content: ''
})

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

const addNote = () => {
  if (noteForm.value.content.trim()) {
    previousNotes.value.unshift({
      id: Date.now(),
      content: noteForm.value.content,
      timestamp: new Date()
    })
    noteForm.value.content = ''
  }
}

interface Document {
  id: number
  name: string
  url: string
  size: string
  icon: string
  iconColor: string
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

const showSubscribeDialog = ref(false)

const openSubscribeDialog = () => {
  showSubscribeDialog.value = true
}

const calculatorSettings = ref({
  downPaymentPercent: 10,
  interestRate: 4.00,
  amortizationYears: 25
})

const formatPrice = (value: number): string => {
  return value.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateDownPayment = (): number => {
  const price = parseFloat(listing.value.price.replace(/,/g, ''))
  return price * (calculatorSettings.value.downPaymentPercent / 100)
}

const calculateLoanAmount = (): number => {
  const price = parseFloat(listing.value.price.replace(/,/g, ''))
  return price - calculateDownPayment()
}

const calculateMonthlyPayment = (): number => {
  const loanAmount = calculateLoanAmount()
  const monthlyRate = calculatorSettings.value.interestRate / 100 / 12
  const numberOfPayments = calculatorSettings.value.amortizationYears * 12
  
  return (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
         (Math.pow(1 + monthlyRate, numberOfPayments) - 1)
}

const calculateTotalMonthly = (): number => {
  return calculateMonthlyPayment() + 450 + 350 // Adding property tax and maintenance
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

.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.text-no-wrap {
  white-space: nowrap;
}
</style> 