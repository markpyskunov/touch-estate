<template>
  <v-container class="py-8 px-4" fluid>
    <v-card class="mx-auto" max-width="500" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5 text-center pa-4">
        Welcome to {{ property?.name || 'the property' }}
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
            v-if="campaign?.flags?.use_email_login"
            :color="form.authMethod === 'email' ? 'primary' : undefined"
            variant="outlined"
            class="text-none flex-grow-1 me-3"
            @click="form.authMethod = 'email'"
          >
            <v-icon start>mdi-email</v-icon>
            Email Login
          </v-btn>

          <v-btn
            v-if="campaign?.flags?.use_sms_login"
            :color="form.authMethod === 'phone' ? 'primary' : undefined"
            variant="outlined"
            class="text-none flex-grow-1"
            @click="form.authMethod = 'phone'"
          >
            <v-icon start>mdi-cellphone</v-icon>
            SMS Login
          </v-btn>
        </div>

        <!-- Email Input -->
        <v-text-field
          v-if="form.authMethod === 'email' && campaign?.flags?.use_email_login"
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
          v-if="form.authMethod === 'phone' && campaign?.flags?.use_sms_login"
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
import { useVisitStore } from '@/stores/visit'

interface Campaign {
  id: string
  flags?: {
    use_email_login?: boolean
    use_sms_login?: boolean
  }
}

interface Property {
  id: string
  name: string
}

const route = useRoute()
const router = useRouter()
const visitStore = useVisitStore()

// Get campaign and property IDs from URL
const campaignId = route.query['campaign'] as string
const propertyId = route.query['property'] as string

const campaign = ref<Campaign | null>(null)
const property = ref<Property | null>(null)
const loading = ref(false)

const form = ref({
  name: '',
  authMethod: 'email' as 'email' | 'phone',
  email: '',
  phone: '',
  consent: false
})

const isFormValid = computed(() => {
  if (!form.value.name || !form.value.consent) return false

  if (form.value.authMethod === 'email') {
    return campaign.value?.flags?.use_email_login && /.+@.+\..+/.test(form.value.email)
  } else {
    return campaign.value?.flags?.use_sms_login && /^\d{10}$/.test(form.value.phone)
  }
})

const fetchData = async () => {
  if (!campaignId || !propertyId) return

  try {
    // Check if visit is already verified
    if (visitStore.isCampaignVerified(campaignId)) {
      router.push({
        path: `/real-estate/property/${propertyId}`,
        query: { campaign: campaignId }
      })
      return
    }

    // Here you would fetch both campaign and property from your API
    // For now, using mock data
    campaign.value = {
      id: campaignId,
      flags: {
        use_email_login: true,
        use_sms_login: true
      }
    }

    property.value = {
      id: propertyId,
      name: '404-1110 Samar crescent'
    }

    // Set default auth method based on available options
    if (campaign.value.flags?.use_email_login) {
      form.value.authMethod = 'email'
    } else if (campaign.value.flags?.use_sms_login) {
      form.value.authMethod = 'phone'
    }
  } catch (error) {
    console.error('Error fetching data:', error)
  }
}

const submitForm = async () => {
  if (!isFormValid.value) return

  loading.value = true

  try {
    // Here you would:
    // 1. Send verification code to email/phone
    // 2. Store the form data temporarily
    // 3. Redirect to verification page

    // Create the visit record
    visitStore.createVisit({
      campaignId,
      propertyId,
      visitorInfo: {
        name: form.value.name,
        ...(
            form.value.authMethod === 'email'
                ? { email: form.value.email }
                : { phone: form.value.phone }
        )
      }
    })

    // Redirect to verification page
    router.push({
      path: '/real-estate/verify',
      query: {
        campaign: campaignId,
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
