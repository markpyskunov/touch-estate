<template>
  <v-container class="py-0 px-4" fluid v-if="visitStore.property">
    <!-- Image Slider Section -->
    <div class="mx-n4">
      <v-carousel
        height="500"
        cycle
        hide-delimiters
        show-arrows="hover"
      >
        <v-carousel-item
          v-for="(image, index) in visitStore.property.location_images ?? []"
          :key="index"
          :src="image.source"
          cover
        />
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
                <div class="d-flex flex-column" v-if="visitStore.property.pricing.price_before && visitStore.property.pricing.price_after">
                    <div class="text-h5 text-decoration-line-through text-disabled font-weight-medium">{{ formatCurrency(visitStore.property.pricing.price_before) }}</div>
                    <div class="text-h3 text-primary font-weight-medium">{{ formatCurrency(visitStore.property.pricing.price_after) }}</div>
                </div>

                <div class="d-flex" v-else-if="visitStore.property.pricing.price_before && !visitStore.property.pricing.price_after">
                    <div class="text-h3 text-primary font-weight-medium">{{ formatCurrency(visitStore.property.pricing.price_before) }}</div>
                </div>

                <div class="d-flex" v-else>
                    <div class="text-h3 text-primary font-weight-medium">Coming soon...</div>
                </div>

              <div class="text-h5 mt-2">{{ visitStore.property.address.street_number }} {{ visitStore.property.address.route }}</div>
              <div class="text-h6 text-grey">{{ visitStore.property.address.administrative_area_level_2 }}, {{ visitStore.property.address.administrative_area_level_1 }}, {{ visitStore.property.address.postal_code }}</div>

              <div class="d-flex align-center mt-2">
                <span class="text-grey me-2">MLS® Number:</span>
                <span>{{ visitStore.property.mls }}</span>
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
                :variant="visitStore.property.is_favorite ? 'flat' : 'outlined'"
                density="comfortable"
                class="text-none"
                color="error"
                prepend-icon="mdi-heart-outline"
                @click="async () => {
                    if (!loadingStore) return;

                    try {
                        loadingStore.show('Processing favourites');
                        await visitStore.toggleFavorite();
                    } catch (err) {
                        console.error(err)
                    } finally {
                      loadingStore.hide();
                    }
                }"
              >
                {{ visitStore.property.is_favorite ? 'Remove from Favourites' : 'Add to Favourites' }}
              </v-btn>
            </div>

            <!-- Bottom Stats -->
            <div class="d-flex justify-space-between" style="width: 100%; gap: 24px;">
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
                <div class="text-caption text-grey">Square Feet</div>
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
                  <template #activator="{ props }">
                    <div v-bind="props">
                      <v-icon size="28">mdi-garage</v-icon>
                      <div
                          class="text-subtitle-1 font-weight-medium"
                          v-if="visitStore.property.rooms.filter(r => r.type === 'parking').length && visitStore.property.rooms.filter(r => r.type === 'garage').length"
                      >
                          {{ visitStore.property.rooms.filter(r => r.type === 'parking').length }} + {{ visitStore.property.rooms.filter(r => r.type === 'garage').length }}
                      </div>

                        <div
                            class="text-subtitle-1 font-weight-medium"
                            v-else-if="visitStore.property.rooms.filter(r => r.type === 'parking').length && !visitStore.property.rooms.filter(r => r.type === 'garage').length"
                        >
                            {{ visitStore.property.rooms.filter(r => r.type === 'parking').length }}
                        </div>

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
          <v-card-title class="text-h4">Main information</v-card-title>
          <v-card-subtitle class="text-h6">{{ visitStore.property.address.formatted_address }}</v-card-subtitle>

          <v-card-text v-if="visitStore.property.description">
            <div class="text-h6 mb-4">Description</div>
            <p class="text-body-1">{{ visitStore.property.description }}</p>
          </v-card-text>

          <v-card-text>
            <div class="text-h6 mb-4">Features</div>
            <v-chip
              v-for="(feature, index) in activeFeatures"
              :key="index"
              class="ma-2"
              color="primary"
              variant="outlined"
            >
                <span v-if="typeof feature.value === 'boolean'">{{ feature.feature }}</span>
                <span v-else-if="typeof feature.value === 'number'">{{ feature.feature }}: {{ feature.value }}</span>
                <span v-else-if="typeof feature.value === 'string'">{{ feature.feature }}: {{ feature.value }}</span>
            </v-chip>
          </v-card-text>
        </v-card>

        <!-- Additional Images -->
        <v-row class="mb-6">
          <v-col cols="6" v-for="(image, index) in visitStore.property.location_images.filter(i => i.is_featured)" :key="index">
            <v-img
              :src="image.source"
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
              />
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
                <tr v-for="room in visitStore.property.rooms" :key="room.id">
                  <td style="width: 120px">
                    <div class="d-flex align-center">
                      <v-icon size="20" class="me-2">{{ getLevelIcon(room.level) }}</v-icon>
                      {{ getLevelLabel(room.level) }}
                    </div>
                  </td>
                  <td style="width: 200px">{{ room.name }}</td>
                  <td style="width: 150px">{{ printRoomSize(room) }}</td>
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
                <div class="text-h5 font-weight-medium text-primary mb-1">{{ visitStore.property.stats.visitors }}</div>
                <div class="text-caption text-grey">Views</div>
              </div>
              <v-divider vertical></v-divider>
              <div class="d-flex flex-column align-center justify-center" style="width: 100%">
                <div class="text-h5 font-weight-medium text-error mb-1">{{ visitStore.property.stats.favorites }}</div>
                <div class="text-caption text-grey">Favorites</div>
              </div>
              <v-divider vertical></v-divider>
              <div class="d-flex flex-column align-center justify-center" style="width: 100%">
                <v-tooltip text="High demand on watching this property" location="bottom">
                  <template #activator="{ props }">
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
            <div v-if="visitStore.property.notes.length > 0" class="mb-6">
              <div class="text-subtitle-1 mb-3">Your Notes</div>
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

            <v-form @submit.prevent="propertyMapperStore.subscribeToProperty">
              <v-textarea
                v-model="propertyMapperStore.subscribeForm.personalNote"
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
                {{ `${visitStore.property.visits.length} visit${visitStore.property.visits.length > 1 ? 's' : ''}` }}
              </v-chip>
            </div>

            <div class="visits-timeline" style="max-height: 200px; overflow-y: auto;">
              <v-timeline density="compact" align="start">
                <v-timeline-item
                  v-for="visit in visitStore.property.visits"
                  :key="visit.id"
                  :dot-color="visit.type === 'nfc' ? 'primary' : visit.type === 'qr' ? 'success' : 'info'"
                  size="small"
                >
                  <div class="text-caption text-grey mb-1">{{ formatDate(visit.created_at) }}</div>
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
          {{ visitStore.property.documents.length }} files
        </v-chip>
      </v-card-title>

      <v-card-text>
        <v-list density="compact">
          <v-list-item
            v-for="doc in visitStore.property.documents"
            :key="doc.id"
            :href="doc.url"
            target="_blank"
            class="px-2"
          >
            <template #prepend>
              <v-icon :color="doc.icon_color" size="20" class="me-2">{{ doc.icon }}</v-icon>
            </template>

            <v-list-item-title class="text-body-2">{{ doc.name }}</v-list-item-title>

            <template #append>
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
              <template #append>
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
              <template #append>
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
              <template #append>
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
                <span class="text-body-2">{{ formatCurrency(finalPrice) }}</span>
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
                <span class="text-body-2">${{ calculatorSettings.propertyTaxes }}/month</span>
              </div>
              <div class="d-flex justify-space-between mb-2">
                <div class="d-flex align-center">
                  <span class="text-body-2">Maintenance Fees</span>
                  <v-tooltip text="Building maintenance / Condo fees" location="right">
                    <template #activator="{ props }">
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
                <span class="text-body-2">${{ propertyMapperStore.calculatorSettings.maintenanceFees }}/month</span>
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
                  :center="{ lat: visitStore.property.address.latitude, lng: visitStore.property.address.longitude }"
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
import InteractiveMap from '@/components/InteractiveMap.vue'
import {useVisitStore} from "@/stores/visit";
import {formatCurrency, formatDate} from "@/shared/helpers";
import {usePropertyMapperStore} from "@/stores/propertyMapper";
import {computed, ref} from "vue";
import {LocationRoom} from "@/contracts/properties";
import {useLoadingStore} from "@/stores/loading";
import {fi} from "vuetify/locale";

const useMetric = ref(false);

const visitStore = useVisitStore();
const loadingStore = useLoadingStore();
const propertyMapperStore = usePropertyMapperStore();
propertyMapperStore.injectProperty(visitStore.property);

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

const calculateDownPayment = (percentage: number): string => {
    return (finalPrice.value / 100 * (percentage / 100)).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateLoanAmount = (downPaymentPercentage: number): string => {
    const downPayment = finalPrice.value / 100 * (downPaymentPercentage / 100)
    return (finalPrice.value / 100 - downPayment).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateMonthlyPayment = (downPaymentPercentage: number): string => {
    const downPayment = finalPrice.value / 100 * (downPaymentPercentage / 100)
    const loanAmount = finalPrice.value / 100 - downPayment
    const monthlyRate = calculatorSettings.value.interestRate / 100 / 12
    const numberOfPayments = calculatorSettings.value.amortizationYears * 12

    const monthlyPayment = (loanAmount * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
        (Math.pow(1 + monthlyRate, numberOfPayments) - 1)

    return monthlyPayment.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

const calculateTotalMonthlyCost = (downPaymentPercentage: number): string => {
    const monthlyPayment = parseFloat(calculateMonthlyPayment(downPaymentPercentage).replace(/,/g, ''))
    const total = monthlyPayment + calculatorSettings.value.propertyTaxes + calculatorSettings.value.maintenanceFees
    return total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
}

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
const finalPrice = computed(() => {
    if (!visitStore.property) {
        return 0;
    }

    if (visitStore.property.pricing.price_before && visitStore.property.pricing.price_after) {
        return visitStore.property.pricing.price_after;
    }

    return visitStore.property.pricing.price_before;
})

const calculatorSettings = ref({
    downPayment: 10,
    interestRate: 4.00,
    amortizationYears: 25,
    propertyTaxes: 450,
    maintenanceFees: 350,
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
