<template>
  <v-container class="py-0 px-4" fluid v-if="visitStore.property">
    <!-- Image Slider Section -->
    <div class="mx-n4">
      <v-carousel
        height="300"
        cycle
        hide-delimiters
        show-arrows="hover"
      >
        <v-carousel-item
          v-for="(image, index) in visitStore.property.location_images ?? []"
          :key="index"
          :src="image.source"
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
          <div class="text-subtitle-1 font-weight-medium">{{ visitStore.property.rooms.filter(r => r.type === 'bedroom').length }}</div>
          <div class="text-caption text-grey">Bedrooms</div>
        </div>
        <div class="text-center">
          <v-icon size="28">mdi-shower</v-icon>
          <div class="text-subtitle-1 font-weight-medium">{{ visitStore.property.rooms.filter(r => r.type === 'bathroom').length }}</div>
          <div class="text-caption text-grey">Bathrooms</div>
        </div>
        <div class="text-center" v-if="visitStore.property.area_sqft">
          <v-icon size="28">mdi-ruler-square</v-icon>
          <div class="text-subtitle-1 font-weight-medium">{{ visitStore.property.area_sqft }}</div>
          <div class="text-caption text-grey">Sq Ft</div>
        </div>
        <div class="text-center" v-if="visitStore.property.rooms.filter(r => r.type === 'parking').length || visitStore.property.rooms.filter(r => r.type === 'garage').length">
          <v-tooltip :text="[
              visitStore.property.rooms.filter(r => r.type === 'parking').length
                  ? `${visitStore.property.rooms.filter(r => r.type === 'parking').length} Parking lot${visitStore.property.rooms.filter(r => r.type === 'parking').length > 1 ? 's' : ''}`
                  : null,
              visitStore.property.rooms.filter(r => r.type === 'garage').length
                  ? `${visitStore.property.rooms.filter(r => r.type === 'garage').length} Garage`
                  : null,
          ].filter(r => !!r).join(' + ')" location="top">
            <template v-slot:activator="{ props }">
              <div v-bind="props">
                <v-icon size="28">mdi-garage</v-icon>
                <div class="text-subtitle-1 font-weight-medium">
                  {{ visitStore.property.rooms.filter(r => r.type === 'parking').length }} + {{ visitStore.property.rooms.filter(r => r.type === 'garage').length }}
                </div>
                <div class="text-caption text-grey">Parking</div>
              </div>
            </template>
          </v-tooltip>
        </div>
      </div>

      <!-- Price and Favorite -->
      <div class="d-flex justify-space-between align-center mb-4">
        <div class="text-h3 text-primary font-weight-medium">{{ formatCurrency(visitStore.property.pricing.price_after || visitStore.property.pricing.price_before) }}</div>
        <v-btn
          icon
          size="large"
          :color="visitStore.property.is_favorite ? 'error' : 'default'"
          variant="text"
          @click="visitStore.toggleFavorite"
        >
          <v-icon>{{ visitStore.property.is_favorite ? 'mdi-heart' : 'mdi-heart-outline' }}</v-icon>
        </v-btn>
      </div>

      <!-- Address Info -->
      <div class="mb-4">
        <div class="text-h6">{{ visitStore.property.address.street_number }} {{ visitStore.property.address.route }}</div>
        <div class="text-subtitle-1 text-grey">{{ visitStore.property.address.administrative_area_level_2 }}, {{ visitStore.property.address.administrative_area_level_1 }}, {{ visitStore.property.address.postal_code }}</div>
        <div class="d-flex align-center mt-2">
          <span class="text-grey me-2">MLS® Number:</span>
          <span>{{ visitStore.property.mls }}</span>
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
        {{ visitStore.property.is_subscribed ? 'Unsubscribe from updates' : 'Subscribe to updates' }}
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
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)" v-if="visitStore.property.realtor">
      <v-card-text class="pt-4">
        <!-- Agent Info -->
        <div class="d-flex align-center">
          <v-avatar size="60" class="me-4">
            <v-img v-if="visitStore.property.realtor.contact.avatar" :src="visitStore.property.realtor.contact.avatar" />
            <v-img v-else src="https://placehold.co/200x200/333/fff?text=Agent" />
          </v-avatar>
          <div>
            <div class="text-h6">{{ visitStore.property.realtor.first_name }} {{ visitStore.property.realtor.last_name }}</div>
            <div class="text-subtitle-2 text-grey">Real Estate Agent</div>
            <div class="mt-2">
              <div class="d-flex align-center mb-1">
                <v-icon size="small" class="me-2">mdi-email</v-icon>
                <a :href="`mailto:${visitStore.property.realtor.contact.email}`" class="text-decoration-none">{{ visitStore.property.realtor.contact.email }}</a>
              </div>
              <div class="d-flex align-center">
                <v-icon size="small" class="me-2">mdi-phone</v-icon>
                <a :href="`tel:${visitStore.property.realtor.contact.phone}`" class="text-decoration-none">{{ visitStore.property.realtor.contact.phone }}</a>
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

          <v-form @submit.prevent="visitStore.toggleSubscribe">
            <v-textarea
              v-model="note"
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
              {{ visitStore.property.is_subscribed ? 'Unsubscribe from updates' : 'Subscribe to updates' }}
            </v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

    <!-- Main Content Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5">Main information</v-card-title>
      <v-card-subtitle class="text-h6">{{ visitStore.property.address.formatted_address }}</v-card-subtitle>

      <v-card-text v-if="visitStore.property.description">
        <div class="text-h6 mb-4">Description</div>
        <p class="text-body-1">{{ visitStore.property.description }}</p>
      </v-card-text>

      <v-card-text>
        <div class="text-h6 mb-4">Features</div>
        <div class="d-flex flex-wrap" style="gap: 8px">
          <v-chip
            v-for="(feature, index) in activeFeatures"
            :key="index"
            class="ma-1"
            color="primary"
            variant="outlined"
          >
            <span v-if="typeof feature.value === 'boolean'">{{ $t(`locations.features.${feature.feature}`) }}</span>
            <span v-else-if="typeof feature.value === 'number'">{{ $t(`locations.features.${feature.feature}`) }}: {{ feature.value }}</span>
            <span v-else-if="typeof feature.value === 'string'">{{ $t(`locations.features.${feature.feature}`) }}: {{ feature.value }}</span>
          </v-chip>
        </div>
      </v-card-text>
    </v-card>

    <!-- Notes Section -->
    <v-card class="mb-6" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-text>
        <!-- Previous Notes -->
        <div v-if="visitStore.property.notes.length > 0" class="mb-6">
          <div class="text-h6 mb-3">Your Notes</div>
          <v-timeline density="compact" align="start">
            <v-timeline-item
              v-for="note in visitStore.property.notes"
              :key="note.id"
              dot-color="primary"
              size="small"
            >
              <div class="text-caption text-grey mb-1">{{ formatDate(new Date(note.created_at)) }}</div>
              <div class="text-body-2">{{ note.note }}</div>
            </v-timeline-item>
          </v-timeline>
        </div>

        <!-- Add Note Form -->
        <div class="text-h6 mb-4">Add Note</div>
        <v-form @submit.prevent="() => {
          visitStore.storeNote(note);
          note = '';
        }">
          <v-textarea
            v-model="note"
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
            :disabled="note.length === 0"
          >
            Save Note
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>

    <!-- Additional Images -->
    <v-row class="mb-6">
      <v-col cols="6" v-for="(image, index) in visitStore.property.location_images.filter(i => i.is_featured)" :key="index">
        <v-img
          :src="image.source"
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
            <tr v-for="room in roomsWithLevelDisplay" :key="room.id">
              <td>
                <v-icon size="20" :title="getLevelLabel(room.level)" v-if="room.showLevel">{{ getLevelIcon(room.level) }}</v-icon>
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
              <td class="text-no-wrap">{{ printRoomSize(room) }}</td>
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
          {{ visitStore.property.documents.length }} files
        </v-chip>
      </v-card-title>

      <v-card-text>
        <v-list density="compact">
          <v-list-item
            v-for="doc in visitStore.property.documents"
            :key="`document_${doc.id}`"
            :href="`/documents?document=${doc.id}`"
            target="_blank"
            class="px-2"
          >
            <template v-slot:prepend>
              <v-icon :color="doc.icon_color" size="20" class="me-2">{{ doc.icon }}</v-icon>
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
      <v-card class="map-card">
        <InteractiveMap
          :center="{ lat: visitStore.property.address.latitude, lng: visitStore.property.address.longitude }"
          :zoom="15"
        />
      </v-card>
    </div>
  </v-container>
</template>

<script setup lang="ts">
import {ref, computed} from 'vue'
import InteractiveMap from '@/components/InteractiveMap.vue'
import {useVisitStore} from "@/stores/visit";
import {formatCurrency, formatDate} from "@/shared/helpers";
import {LocationRoom} from "@/contracts/properties";

const visitStore = useVisitStore();
const useMetric = ref(false);
const note = ref('');
const showSubscribeDialog = ref(false);

const activeFeatures = computed(() => {
    if (!visitStore.property) {
        return [];
    }

    return visitStore.property.features.filter(feature => {
        if (typeof feature.value === 'boolean') {
            return feature.value;
        }

        return true;
    })
})

const roomsWithLevelDisplay = computed(() => {
    if (!visitStore.property) {
        return [];
    }

    return visitStore.property.rooms.map((room, index) => {
        const showLevel = index === 0 || room.level !== visitStore.property.rooms[index - 1].level;
        return {
            ...room,
            showLevel
        };
    });
})

const getLevelIcon = (level: number): string => {
    switch (level) {
        case -2:
            return 'mdi-home-negative-1'
        case -1:
            return 'mdi-home-floor-l'
        case 1:
            return 'mdi-home-floor-1'
        case 2:
            return 'mdi-home-floor-2'
        case 3:
            return 'mdi-home-floor-3'
        case 4:
            return 'mdi-home-floor-4'
        case 0:
            return 'mdi-home-floor-b'
        default:
            return 'mdi-home-floor-1'
    }
}

const getLevelLabel = (level: number): string => {
    switch (level) {
        case -2:
            return 'Underground 2'
        case -1:
            return 'Underground'
        case 1:
            return '1st floor'
        case 2:
            return '2nd floor'
        case 3:
            return '3rd floor'
        case 4:
            return '4th floor'
        case 0:
            return 'basement'
        default:
            return '1st floor'
    }
}

const printRoomSize = (room: LocationRoom) => {
    if (!useMetric.value) {
        return `${room.width_ft} x ${room.length_ft}`
    }

    return `${room.width_meters} x ${room.length_meters}`
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
    const price = visitStore.property.pricing.price_after || visitStore.property.pricing.price_before;
    return price * (calculatorSettings.value.downPaymentPercent / 100)
}

const calculateLoanAmount = (): number => {
    const price = visitStore.property.pricing.price_after || visitStore.property.pricing.price_before;
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

const openSubscribeDialog = () => {
    showSubscribeDialog.value = true
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
