import { defineStore } from 'pinia'
import { ref } from 'vue'
import {Property, VisitSource} from "@/contracts/properties";
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
  const vid = ref<string | null>(localStorage.getItem(VISITOR_ID_KEY))
    const visitSource = ref<VisitSource>('website');

  if (!vid.value) {
    vid.value = crypto.randomUUID()
    localStorage.setItem(VISITOR_ID_KEY, vid.value)
  }

  const property = ref<Property>();
  const visitVerification = ref<VisitVerification>();
  const authMethod = ref<AuthMethod>('email');
  const loading = ref(false);
  const error = ref<string>();
  const collectedData = ref<Record<string, string>>({});

  async function fetchPropertyUsingSidAndAccessCode(propertyId: string, sid: string, accessCode: string) {
    try {
      loading.value = true;
      error.value = null;
      const { data } = await axios.get<Property>(`/api/v1/visitors/properties/${vid.value}/${propertyId}`, {
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

    async function fetchPropertyUsingVID(propertyId: string) {
        try {
            loading.value = true;
            error.value = null;
            const { data } = await axios.get<Property>(`/api/v1/visitors/properties/${vid.value}/${propertyId}`, {
                params: {
                    utm_source: visitSource.value,
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
        try {
            loading.value = true;
            error.value = null;

            if (!property.value) {
                throw new Error('Property must be fetched first');
            }

            const { data } = await axios.get<VisitVerification>(`/api/v1/visitors/verify-visit/${vid.value}/${propertyId}/${property.value.campaign.id}`, {
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
    try {
        loading.value = true;
        error.value = null;
        collectedData.value = data;

        if (!property.value) {
            throw new Error('Property must be fetched first');
        }

      const { data: sendVerificationCodeResponse } = await axios.post<VisitVerification>(`/api/v1/visitors/verify-visit/${vid.value}/${property.value.id}/${property.value.campaign.id}`, data);

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
    try {
        loading.value = true;
        error.value = null;

        if (!property.value) {
            throw new Error('Property must be fetched first');
        }

      const { data } = await axios.patch<VisitVerification>(`/api/v1/visitors/verify-visit/${vid.value}/${property.value.id}/${property.value.campaign.id}`, {
        code,
          utm_source: visitSource.value,
          ...collectedData.value,
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

    async function toggleFavorite() {
        try {
            loading.value = true;
            error.value = null;

            if (!property.value) {
                throw new Error('Property must be fetched first');
            }

            const { data } = await axios.patch<Property>(`/api/v1/visitors/toggle-favorite/${vid.value}/${property.value.id}`);

            property.value = data;
        } catch (err) {
            error.value = err instanceof Error ? err.message : 'Failed to verify code';
            throw err;
        } finally {
            loading.value = false;
        }
    }

  return {
    vid,
    visitSource,
    authMethod,
    property,
    visitVerification,
    loading,
    error,
    fetchPropertyUsingVID,
    fetchPropertyUsingSidAndAccessCode,
    sendVerificationCode,
    verifyCode,
    checkVerificationStatus,
      toggleFavorite,
  }
})
