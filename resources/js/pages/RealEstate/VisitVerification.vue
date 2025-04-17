<template>
  <v-container class="py-8 px-4" fluid v-if="visitStore.property && visitStore.property.campaign">
    <v-card class="mx-auto" max-width="500" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5 text-center pa-4">
        {{ visitStore.property.campaign.title || 'Verification code needed' }}
      </v-card-title>

      <v-card-text class="text-center pa-4">
        <h2 class="text-h5 mb-4">{{ verificationStage.title }}</h2>
        <p class="text-body-1 mb-6">{{ verificationStage.description }}</p>
        <v-otp-input
          v-model="verificationCode"
          :length="6"
          variant="outlined"
          class="mb-6"
        />
        <v-btn
          color="primary"
          size="large"
          block
          :loading="isSubmitting"
          @click="submitForm"
        >
          {{ verificationStage.buttonText }}
        </v-btn>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import {useVisitStore, VisitVerification} from '@/stores/visit'
import axios from "axios";

const router = useRouter()
const visitStore = useVisitStore()

const verificationCode = ref('')
const isSubmitting = ref(false)

const verificationMethod = computed(() => visitStore.authMethod === 'email'
    ? 'email'
    : 'phone'
)

const verificationStage = computed(() => {
  if (verificationMethod.value === 'email') {
    return {
      title: 'Check your Email',
      description: 'We sent a verification code to your email address. Please enter it below to continue.',
      buttonText: 'Verify Email'
    }
  } else {
    return {
      title: 'Check your Phone',
      description: 'We sent a verification code to your phone number. Please enter it below to continue.',
      buttonText: 'Verify Phone'
    }
  }
})

const submitForm = async () => {
  if (!verificationCode.value || verificationCode.value.length !== 6) return
  if (!visitStore.property) return

  isSubmitting.value = true

  try {
    await axios.patch<VisitVerification>(`/api/v1/visitors/verify-visit/${visitStore.visitorId}/${visitStore.property.id}/${visitStore.property.campaign.id}`, {
        code: verificationCode.value,
    });

    // Redirect to the property page with campaign ID
    router.push({
      path: `/real-estate/property/${visitStore.property.id}`,
    })
  } catch (error) {
    console.error('Error submitting form:', error)
    // Show error to user
    alert('Verification failed. Please try again.')
  } finally {
    isSubmitting.value = false
  }
}
</script>
