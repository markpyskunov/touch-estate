import { defineStore } from 'pinia'
import { ref } from 'vue'

interface VisitorInfo {
  id: string
  name: string
  email?: string
  phone?: string
  createdAt: string
}

interface Visit {
  campaignId: string
  propertyId: string
  visitedAt: string
  isVerified: boolean
}

interface Visitor {
  id: string
  email?: string
  phone?: string
  createdAt: string
}

interface StoredData {
  visitor: Visitor | null
  visits: Visit[]
}

const STORAGE_KEY = 'nfc_qr_real_estate_visits'
const VISITOR_TTL_DAYS = 30 // Visitor data expires after 30 days

export const useVisitStore = defineStore('visit', () => {
  // Initialize state from localStorage or defaults
  const initialState: StoredData = JSON.parse(localStorage.getItem(STORAGE_KEY) || '{"visitor":null,"visits":[]}')

  const visitor = ref<Visitor | null>(initialState.visitor)
  const visits = ref<Visit[]>(initialState.visits)

  // Check if visitor data is expired
  const isVisitorExpired = (visitor: Visitor): boolean => {
    const createdAt = new Date(visitor.createdAt)
    const now = new Date()
    const daysSinceCreation = (now.getTime() - createdAt.getTime()) / (1000 * 60 * 60 * 24)
    return daysSinceCreation > VISITOR_TTL_DAYS
  }

  function getCurrentVisit(campaignId: string) {
    return visits.value.find(v => v.campaignId === campaignId)
  }

  function isCampaignVerified(campaignId: string) {
    const visit = getCurrentVisit(campaignId)
    return visit?.isVerified || false
  }

  function getPropertyId(campaignId: string) {
    const visit = getCurrentVisit(campaignId)
    return visit?.propertyId
  }

  function createVisit(data: {
    campaignId: string
    propertyId: string
    visitorInfo: Omit<Visitor, 'id' | 'createdAt'>
  }) {
    const now = new Date().toISOString()

    // If no visitor exists or visitor is expired, create a new one
    if (!visitor.value || isVisitorExpired(visitor.value)) {
      visitor.value = {
        ...data.visitorInfo,
        id: crypto.randomUUID(),
        createdAt: now
      }
    }

    // Check if visit already exists
    const existingVisitIndex = visits.value.findIndex(v => v.campaignId === data.campaignId)
    if (existingVisitIndex >= 0) {
      // Update existing visit but keep isVerified as false
      visits.value[existingVisitIndex] = {
        campaignId: data.campaignId,
        propertyId: data.propertyId,
        visitedAt: now,
        isVerified: false
      }
    } else {
      // Create new visit with isVerified as false
      visits.value.push({
        campaignId: data.campaignId,
        propertyId: data.propertyId,
        visitedAt: now,
        isVerified: false
      })
    }

    // Persist to localStorage
    localStorage.setItem(STORAGE_KEY, JSON.stringify({
      visitor: visitor.value,
      visits: visits.value
    }))
  }

  function setVerified(campaignId: string) {
    const visitIndex = visits.value.findIndex(v => v.campaignId === campaignId)
    if (visitIndex >= 0) {
      const existingVisit = visits.value[visitIndex]!
      visits.value[visitIndex] = {
        campaignId: existingVisit.campaignId,
        propertyId: existingVisit.propertyId,
        visitedAt: existingVisit.visitedAt,
        isVerified: true
      }

      // Persist to localStorage
      localStorage.setItem(STORAGE_KEY, JSON.stringify({
        visitor: visitor.value,
        visits: visits.value
      }))
    }
  }

  function clear() {
    visitor.value = null
    visits.value = []
    localStorage.removeItem(STORAGE_KEY)
  }

  return {
    visitor,
    visits,
    getCurrentVisit,
    isCampaignVerified,
    getPropertyId,
    createVisit,
    setVerified,
    clear
  }
}) 