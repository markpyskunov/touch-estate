<template>
  <v-container class="py-8 px-4" fluid>
    <v-card class="mx-auto" max-width="500" flat style="border: 1px solid rgba(0,0,0,0.12)">
      <v-card-title class="text-h5 text-center pa-4">
        {{ campaign?.title || 'Verification code needed' }}
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
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { useVisitStore } from '@/stores/visit'

interface Campaign {
  id: string
  title: string
}

const route = useRoute()
const router = useRouter()
const visitStore = useVisitStore()

// Get campaign ID from URL
const campaignId = route.query['campaign'] as string

const campaign = ref<Campaign | null>(null)
const verificationCode = ref('')
const isSubmitting = ref(false)

const verificationMethod = computed(() => {
  return visitStore.visitor?.email ? 'email' : 'phone'
})

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

const fetchCampaign = async () => {
  if (!campaignId) return

  try {
    // Here you would fetch the campaign from your API
    // For now, using mock data
    campaign.value = {
      id: campaignId,
      title: 'Welcome to 404-1110 Samar crescent'
    }
  } catch (error) {
    console.error('Error fetching campaign:', error)
  }
}

const submitForm = async () => {
  if (!verificationCode.value || verificationCode.value.length !== 6) return

  isSubmitting.value = true

  try {
    // Demo code check
    if (verificationCode.value === '000000') {
      // Mark the visit as verified
      visitStore.setVerified(campaignId)

      // Redirect to property page
      router.push({
        path: '/real-estate/property/1',
        query: { campaign: campaignId }
      })
      return
    }

    // Here you would:
    // 1. Verify the code with your backend
    // 2. Update the visit status
    // 3. Redirect to the property page

    // Get the property ID from the store
    const propertyId = visitStore.getPropertyId(campaignId)
    if (!propertyId) {
      throw new Error('Property ID not found')
    }

    // Mark the visit as verified
    visitStore.setVerified(campaignId)

    // Redirect to the property page with campaign ID
    router.push({
      path: `/real-estate/property/${propertyId}`,
      query: { campaign: campaignId }
    })
  } catch (error) {
    console.error('Error submitting form:', error)
    // Show error to user
    alert('Verification failed. Please try again.')
  } finally {
    isSubmitting.value = false
  }
}

onMounted(() => {
  fetchCampaign()
})
</script>
