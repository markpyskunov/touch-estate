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

        <!-- Dynamic Form Fields -->
        <template v-for="field in campaignFields" :key="field.id">
          <v-text-field
            v-if="field.type === 'input[type=text]'"
            v-model="form[field.id]"
            :label="field.label || field.id"
            variant="outlined"
            density="comfortable"
            class="mb-6"
            :rules="getFieldRules(field)"
            :required="field.required"
          />

<!--          <v-textarea-->
<!--            v-else-if="field.type === 'textarea'"-->
<!--            v-model="form[field.id]"-->
<!--            :label="field.label || field.id"-->
<!--            variant="outlined"-->
<!--            density="comfortable"-->
<!--            class="mb-6"-->
<!--            :rules="getFieldRules(field)"-->
<!--            :required="field.required"-->
<!--            rows="3"-->
<!--          />-->

<!--          <v-select-->
<!--            v-else-if="field.type === 'select'"-->
<!--            v-model="form[field.id]"-->
<!--            :label="field.label || field.id"-->
<!--            :items="field.options || []"-->
<!--            variant="outlined"-->
<!--            density="comfortable"-->
<!--            class="mb-6"-->
<!--            :rules="getFieldRules(field)"-->
<!--            :required="field.required"-->
<!--          />-->

<!--          <v-checkbox-->
<!--            v-else-if="field.type === 'checkbox'"-->
<!--            v-model="form[field.id]"-->
<!--            :label="field.label || field.id"-->
<!--            class="mb-6"-->
<!--            :rules="getFieldRules(field)"-->
<!--            :required="field.required"-->
<!--          />-->
        </template>

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

        <!-- Dynamic Authentication Fields -->
        <template v-if="visitStore.authMethod === 'email' && visitStore.property.campaign.payload.flags.use_email_login">
          <v-text-field
            v-model="form['email']!"
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
        </template>

        <template v-if="visitStore.authMethod === 'phone' && visitStore.property.campaign.payload.flags.use_sms_login">
          <v-text-field
            v-model="form['phone']!"
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
        </template>

        <!-- Consent Form -->
        <v-checkbox
          v-model="consent"
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
import {useVisitStore} from '@/stores/visit'
import {useLoadingStore} from "@/stores/loading";

const route = useRoute()
const router = useRouter()
const visitStore = useVisitStore()
const loadingStore = useLoadingStore()

// Get campaign and property IDs from URL
const propertyId = route.query['property'] as string
const force = !!route.query['force']

const loading = ref(false)

// Initialize form with dynamic fields
const form = ref<Record<string, string>>({})
const consent = ref(false)

// Computed property for campaign fields
const campaignFields = computed(() => {
  if (!visitStore.property?.campaign.payload.fields) return []
  return visitStore.property.campaign.payload.fields
})

// Function to get validation rules for a field
const getFieldRules = (field: any) => {
  const rules = []
  if (field.required) {
    rules.push((v: any) => !!v || `${field.label || field.id} is required`)
  }
  if (field.validation) {
    if (field.validation.pattern) {
      rules.push((v: any) => new RegExp(field.validation.pattern).test(v) || field.validation.message || 'Invalid format')
    }
    if (field.validation.min) {
      rules.push((v: any) => v.length >= field.validation.min || `Minimum ${field.validation.min} characters required`)
    }
    if (field.validation.max) {
      rules.push((v: any) => v.length <= field.validation.max || `Maximum ${field.validation.max} characters allowed`)
    }
  }
  return rules
}

// Computed property for form validation
const isFormValid = computed(() => {
  if (!visitStore.property) return false
  if (!consent.value) return false

  // Check dynamic fields
  for (const field of campaignFields.value) {
    if (field.required && !form.value[field.id]) return false
    if (field.validation) {
      const value = form.value[field.id]
        if (value) {
            if (field.validation.pattern && !new RegExp(field.validation.pattern).test(value)) return false
            if (field.validation.min && value.length < field.validation.min) return false
            if (field.validation.max && value.length > field.validation.max) return false
        }
    }
  }

  // Check auth method fields based on campaign flags
  if (visitStore.authMethod === 'email' && visitStore.property.campaign.payload.flags.use_email_login) {
    return /.+@.+\..+/.test(form.value['email']!)
  } else if (visitStore.authMethod === 'phone' && visitStore.property.campaign.payload.flags.use_sms_login) {
    return /^\d{10}$/.test(form.value['phone']!)
  }

  return false
})

const fetchData = async () => {
  if (!propertyId) return

  try {
    loadingStore.show()
    await visitStore.fetchProperty(
      propertyId,
      route.query['sid'] as string,
      route.query['access_code'] as string
    )

    if (!visitStore.property) {
      throw new Error('Something went wrong - code 1')
    }

    await visitStore.checkVerificationStatus(propertyId, force)

    if (!visitStore.visitVerification) {
      throw new Error('Something went wrong - code 2')
    }

    if (visitStore.visitVerification.is_verified) {
      router.push({
        path: `/real-estate/property/${propertyId}`
      })
      return
    }

    // Set default auth method based on available options
    if (visitStore.property.campaign.payload.flags.use_email_login) {
      visitStore.authMethod = 'email'
    } else if (visitStore.property.campaign.payload.flags.use_sms_login) {
      visitStore.authMethod = 'phone'
    }
  } catch (error) {
    console.error('Error fetching data:', error)
  } finally {
    loadingStore.hide()
  }
}

const submitForm = async () => {
  if (!isFormValid.value) return
  if (!visitStore.property) return

  try {
    await visitStore.sendVerificationCode({
      ...form.value,
      consent: consent.value
    })

    router.push({
      path: '/real-estate/verify',
      query: {
        campaign: visitStore.property.campaign.id,
        sid: route.query['sid'],
        access_code: route.query['access_code']
      }
    })
  } catch (error) {
    console.error('Error submitting form:', error)
  }
}

onMounted(() => {
  fetchData()
})
</script>
