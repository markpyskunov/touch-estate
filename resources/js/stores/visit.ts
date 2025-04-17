import { defineStore } from 'pinia'
import { ref } from 'vue'
import {Property} from "@/contracts/properties";
import axios from 'axios';

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
  const loading = ref(false);
  const error = ref<string | null>(null);

  async function fetchProperty(propertyId: string, sid: string, accessCode: string) {
    loading.value = true;
    error.value = null;

    try {
      const { data } = await axios.get<Property>(`/api/v1/visitors/properties/${propertyId}`, {
        params: {
            sid,
            access_code: accessCode,
        }
      });

      property.value = data;
      return data;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Failed to fetch property';
      throw err;
    } finally {
      loading.value = false;
    }
  }

    async function checkVerificationStatus(propertyId: string, force: boolean = false) {
        loading.value = true;
        error.value = null;

        try {
            if (!property.value) {
                throw new Error('Property must be fetched fisrt');
            }

            const { data } = await axios.get<VisitVerification>(`/api/v1/visitors/verify-visit/${visitorId.value}/${propertyId}/${property.value.campaign.id}`, {
                params: { force }
            });

            visitVerification.value = data;
            return data;
        } catch (err) {
            error.value = err instanceof Error ? err.message : 'Failed to check verification status';
            throw err;
        } finally {
            loading.value = false;
        }
    }

  async function sendVerificationCode(data: Record<string, string>) {
    loading.value = true;
    error.value = null;

    try {
        if (!property.value) {
            throw new Error('Property must be fetched fisrt');
        }

      const { data: sendVerificationCodeResponse } = await axios.post<VisitVerification>(`/api/v1/visitors/verify-visit/${visitorId.value}/${property.value.id}/${property.value.campaign.id}`, data);

      visitVerification.value = sendVerificationCodeResponse;
      return sendVerificationCodeResponse;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Failed to send verification code';
      throw err;
    } finally {
      loading.value = false;
    }
  }

  async function verifyCode(code: string) {
    loading.value = true;
    error.value = null;

    try {
        if (!property.value) {
            throw new Error('Property must be fetched fisrt');
        }

      const { data } = await axios.patch<VisitVerification>(`/api/v1/visitors/verify-visit/${visitorId.value}/${property.value.id}/${property.value.campaign.id}`, {
        code,
      });

      visitVerification.value = data;
        return data;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Failed to verify code';
      throw err;
    } finally {
      loading.value = false;
    }
  }

  return {
    visitorId,
    authMethod,
    property,
    visitVerification,
    loading,
    error,
    fetchProperty,
    sendVerificationCode,
    verifyCode,
    checkVerificationStatus,
  }
})
