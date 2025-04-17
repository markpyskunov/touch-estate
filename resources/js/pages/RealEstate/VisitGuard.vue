<template>
  <v-container class="py-8 px-4" fluid v-if="visitStore.property">
    <v-card class="mx-auto" max-width="500" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5 text-center pa-4">
        Welcome to {{ visitStore.property.name || 'the property' }}
      </v-card-title>

      <v-card-text class="pa-4">
        <p class="text-body-1 mb-6">
          Please provide your contact information to access the property details.
          We'll send you a verification code to confirm your identity.
        </p>

        <!-- Name Input -->
        <v-text-field
          v-model="form.name"
          label="Full Name"
          variant="outlined"
          density="comfortable"
          class="mb-6"
          :rules="[v => !!v || 'Name is required']"
          required
        />

        <!-- Authentication Method Selection -->
        <div class="d-flex mb-6">
          <v-btn
            v-if="visitStore.property.campaign.payload.flags.use_email_login"
            :color="visitStore.authMethod === 'email' ? 'primary' : undefined"
            variant="outlined"
            class="text-none flex-grow-1 me-3"
            @click="visitStore.authMethod = 'email'"
          >
            <v-icon start>mdi-email</v-icon>
            Email Login
          </v-btn>

          <v-btn
            v-if="visitStore.property.campaign.payload.flags.use_sms_login"
            :color="visitStore.authMethod === 'phone' ? 'primary' : undefined"
            variant="outlined"
            class="text-none flex-grow-1"
            @click="visitStore.authMethod = 'phone'"
          >
            <v-icon start>mdi-cellphone</v-icon>
            SMS Login
          </v-btn>
        </div>

        <!-- Email Input -->
        <v-text-field
          v-if="visitStore.authMethod === 'email' && visitStore.property.campaign.payload.flags.use_email_login"
          v-model="form.email"
          label="Email Address"
          type="email"
          variant="outlined"
          density="comfortable"
          class="mb-6"
          :rules="[
            v => !!v || 'Email is required',
            v => /.+@.+\..+/.test(v) || 'Email must be valid'
          ]"
          required
        />

        <!-- Phone Input -->
        <v-text-field
          v-if="visitStore.authMethod === 'phone' && visitStore.property.campaign.payload.flags.use_sms_login"
          v-model="form.phone"
          label="Phone Number"
          variant="outlined"
          density="comfortable"
          class="mb-6"
          :rules="[
            v => !!v || 'Phone number is required',
            v => /^\d{10}$/.test(v) || 'Phone must be 10 digits'
          ]"
          required
        >
          <template v-slot:prepend-inner>
            <span class="text-grey">+1</span>
          </template>
        </v-text-field>

        <!-- Consent Form -->
        <v-checkbox
          v-model="form.consent"
          class="mb-6"
          :rules="[v => !!v || 'The consent is required to continue']"
          required
        >
          <template v-slot:label>
            <div class="text-body-2">
              I agree to receive a one-time notification about this property visit.
              I understand that I can subscribe to receive ongoing updates by providing additional consent later.
            </div>
          </template>
        </v-checkbox>

        <!-- Submit Button -->
        <v-btn
          color="primary"
          block
          size="large"
          class="text-none"
          :loading="loading"
          :disabled="!isFormValid"
          @click="submitForm"
        >
          Continue
        </v-btn>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import {useVisitStore, VisitVerification} from '@/stores/visit'
import {Property} from "@/contracts/properties";
import { useLoadingStore } from '@/stores/loading'
import axios from 'axios';

const route = useRoute()
const router = useRouter()
const loadingStore = useLoadingStore()
const visitStore = useVisitStore()

// Get campaign and property IDs from URL
const propertyId = route.query['property'] as string
const force = !!route.query['force']

const loading = ref(false)

const form = ref({
  name: '',
  email: '',
  phone: '',
  consent: false
})

const isFormValid = computed(() => {
  if (!form.value.name || !form.value.consent) return false
  if (!visitStore.property) return false

  if (visitStore.authMethod === 'email') {
    return visitStore.property.campaign.payload.flags.use_email_login && /.+@.+\..+/.test(form.value.email)
  } else {
    return visitStore.property.campaign.payload.flags.use_sms_login && /^\d{10}$/.test(form.value.phone)
  }
})

const fetchData = async () => {
  if (!propertyId) return

  try {
      loadingStore.show()

    const { data: propertyResponse } = await axios.get<Property>(`/api/v1/visitors/properties/${propertyId}`, {
      params: {
        property_id: propertyId,
        sid: route.query['sid'],
        access_code: route.query['access_code'],
      }
    });
    visitStore.property = propertyResponse;

    const { data: visitVerificationResponse } = await axios.get<VisitVerification>(`/api/v1/visitors/verify-visit/${visitStore.visitorId}/${propertyId}/${visitStore.property.campaign.id}`, {
        params: {
            force,
        }
    });

      visitStore.visitVerification = visitVerificationResponse;

      if (visitStore.visitVerification.is_verified) {
          router.push({
              path: `/real-estate/property/${propertyId}`,
              query: {
                  campaign: visitStore.property.campaign.id,
                  property: propertyId
              }
          });
          return;
      }

    // Set default auth method based on available options
    if (visitStore.property.campaign.payload.flags.use_email_login) {
      visitStore.authMethod = 'email'
    } else if (visitStore.property.campaign.payload.flags.use_sms_login) {
      visitStore.authMethod = 'phone'
    }
  } catch (error) {
    console.error('Error fetching data:', error)
    // Handle error appropriately
  } finally {
      loadingStore.hide();
  }
}

const submitForm = async () => {
  if (!isFormValid.value) return
  if (!visitStore.property) return

  loading.value = true

  try {
      await axios.post<VisitVerification>(`/api/v1/visitors/verify-visit/${visitStore.visitorId}/${propertyId}/${visitStore.property.campaign.id}`, {
          type: visitStore.authMethod,
          contact: visitStore.authMethod === 'email'
              ? form.value.email
              : form.value.phone,
          name: form.value.name,
      });

    // Redirect to verification page
    router.push({
      path: '/real-estate/verify',
      query: {
        campaign: visitStore.property.campaign.id,
        property: propertyId
      }
    })
  } catch (error) {
    console.error('Error submitting form:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchData()
})
</script>
