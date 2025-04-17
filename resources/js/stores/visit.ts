import { defineStore } from 'pinia'
import { ref } from 'vue'
import {Property} from "@/contracts/properties";

const VISITOR_ID_KEY = 'vid'

export interface VisitVerification {
    is_verified: boolean;
    verification_sent: boolean;
}

type AuthMethod =
    | 'email'
    | 'phone'

export const useVisitStore = defineStore('visit', () => {
  const visitorId = ref<string | null>(localStorage.getItem(VISITOR_ID_KEY))

  if (!visitorId.value) {
    visitorId.value = crypto.randomUUID()
    localStorage.setItem(VISITOR_ID_KEY, visitorId.value)
  }

  const property = ref<Property | null>(null);
  const visitVerification = ref<VisitVerification | null>(null);
  const authMethod = ref<AuthMethod>('email');

  return {
    visitorId,
    authMethod,
    property,
    visitVerification,
  }
})
