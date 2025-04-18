import { defineStore } from 'pinia'
import { ref } from 'vue'
import {Property} from "@/contracts/properties";

interface SubscribeForm {
    personalNote: string
}

interface Note {
    id: number
    content: string
    timestamp: Date
}

interface RoomDimensions {
    width: number
    length: number
}

interface Room {
    id: number
    level: string
    name: string
    dimensions: RoomDimensions
}

interface Document {
    id: number
    name: string
    url: string
    size: string
    icon: string
    iconColor: string
}

interface Visit {
    id: number
    visitorName: string
    timestamp: Date
    type: 'nfc' | 'qr' | 'website'
}

export const usePropertyMapperStore = defineStore('propertyMapper', () => {
  const property = ref<Property>();
    const allImages = ref([
        {
            url: '/images/properties/bathroom.jpg',
            title: 'Front View'
        },
        {
            url: '/images/properties/living-room-1.jpg',
            title: 'Living Room'
        },
        {
            url: '/images/properties/kitchen-1.jpg',
            title: 'Kitchen'
        },
        {
            url: '/images/properties/bedroom-1.jpg',
            title: 'Bedroom'
        },
        {
            url: '/images/properties/bathroom.jpg',
            title: 'Bathroom'
        }
    ]);
    const listing = ref();
    const useMetric = ref(true)
    const rooms = ref<Room[]>([
        {
            id: 1,
            level: 'Main Floor',
            name: 'Living Room',
            dimensions: { width: 6.1, length: 7.3 }
        },
        {
            id: 2,
            level: 'Main Floor',
            name: 'Kitchen',
            dimensions: { width: 4.2, length: 5.5 }
        },
        {
            id: 3,
            level: 'Main Floor',
            name: 'Dining Room',
            dimensions: { width: 3.9, length: 4.8 }
        },
        {
            id: 4,
            level: 'Upper Floor',
            name: 'Master Bedroom',
            dimensions: { width: 4.5, length: 5.8 }
        },
        {
            id: 5,
            level: 'Upper Floor',
            name: 'Bedroom 2',
            dimensions: { width: 3.6, length: 4.2 }
        },
        {
            id: 6,
            level: 'Upper Floor',
            name: 'Family Bathroom',
            dimensions: { width: 2.8, length: 3.2 }
        },
        {
            id: 7,
            level: 'Third Floor',
            name: 'Bedroom 3',
            dimensions: { width: 3.3, length: 4.0 }
        },
        {
            id: 8,
            level: 'Third Floor',
            name: 'Study Room',
            dimensions: { width: 3.0, length: 3.5 }
        },
        {
            id: 9,
            level: 'Third Floor',
            name: 'Half Bath',
            dimensions: { width: 1.8, length: 2.4 }
        }
    ])
    const previousNotes = ref<Note[]>([
        {
            id: 1,
            content: "Great location, close to schools and parks. Need to check the garage size.",
            timestamp: new Date('2024-03-15T14:30:00')
        },
        {
            id: 2,
            content: "Called agent about the roof age - was replaced in 2020.",
            timestamp: new Date('2024-03-16T09:15:00')
        }
    ])
    const subscribeForm = ref<SubscribeForm>({
        personalNote: ''
    })
    const visits = ref<Visit[]>([
        {
            id: 1,
            visitorName: 'John D.',
            timestamp: new Date('2024-03-20T14:30:00'),
            type: 'nfc'
        },
        {
            id: 2,
            visitorName: 'Sarah M.',
            timestamp: new Date('2024-03-20T11:15:00'),
            type: 'website'
        },
        {
            id: 3,
            visitorName: 'Mike R.',
            timestamp: new Date('2024-03-19T16:45:00'),
            type: 'qr'
        },
        {
            id: 4,
            visitorName: 'Emma L.',
            timestamp: new Date('2024-03-19T13:20:00'),
            type: 'website'
        }
    ])
    const documents = ref<Document[]>([
        {
            id: 1,
            name: 'Property Disclosure Statement.pdf',
            url: '#',
            size: '2.4 MB',
            icon: 'mdi-file-document-outline',
            iconColor: 'primary'
        },
        {
            id: 2,
            name: 'Floor Plans.pdf',
            url: '#',
            size: '5.1 MB',
            icon: 'mdi-floor-plan',
            iconColor: 'success'
        },
        {
            id: 3,
            name: 'Property Survey.pdf',
            url: '#',
            size: '3.8 MB',
            icon: 'mdi-map-outline',
            iconColor: 'info'
        },
        {
            id: 4,
            name: 'Title Certificate.pdf',
            url: '#',
            size: '1.2 MB',
            icon: 'mdi-certificate-outline',
            iconColor: 'warning'
        }
    ])
    const calculatorSettings = ref({
        downPayment: 10,
        interestRate: 4.00,
        amortizationYears: 25,
        propertyTaxes: 450,
        maintenanceFees: 350,
    })
    const coordinates = { lat: 48.44705905509525, lng: -123.54380246952951 }

    const getLevelIcon = (level: string): string => {
        switch (level) {
            case 'Main Floor':
                return 'mdi-home-floor-1'
            case 'Upper Floor':
                return 'mdi-home-floor-2'
            case 'Third Floor':
                return 'mdi-home-floor-3'
            case 'Basement':
                return 'mdi-home-floor-b'
            default:
                return 'mdi-home-floor-1'
        }
    }

    const formatDate = (date: Date): string => {
        return new Intl.DateTimeFormat('en-US', {
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric'
        }).format(date)
    }

    const subscribeToProperty = () => {
        // We'll get email from Pinia state here
        console.log('Subscription submitted:', subscribeForm.value)
    }

    const formatVisitDate = (date: Date): string => {
        const now = new Date()
        const diff = now.getTime() - date.getTime()
        const hours = Math.floor(diff / (1000 * 60 * 60))

        if (hours < 24) {
            return `${hours}h ago`
        } else {
            return formatDate(date)
        }
    }

  const injectProperty = (injectProperty: Property) => {
      property.value = injectProperty;

      listing.value = {
          title: 'Main information',
          address: '1110 Samar Cres',
          city: 'Langford',
          province: 'British Columbia',
          postalCode: 'V9B 0A1',
          mainImage: '/images/properties/bathroom.jpg',
          images: [
              { url: '/images/properties/living-room-1.jpg' },
              { url: '/images/properties/kitchen-1.jpg' },
              { url: '/images/properties/bedroom-1.jpg' },
              { url: '/images/properties/bathroom.jpg' }
          ],
          additionalImages: [
              { url: '/images/properties/living-room-2.jpg', title: 'Living Room' },
              { url: '/images/properties/kitchen-2.jpg', title: 'Kitchen' },
              { url: '/images/properties/bedroom-2.jpg', title: 'Bedroom' },
          ],
          description: 'Beautiful family home in the desirable Langford area. This spacious property features 4 bedrooms, 3 bathrooms, and a large backyard perfect for entertaining. The home has been recently updated with modern finishes while maintaining its classic charm.',
          features: [
              'Modern Kitchen',
              'Hardwood Floors',
              'Fireplace',
              'Central Air',
              'Large Backyard',
              'Updated Bathrooms',
              'Walk-in Closets',
              'Energy Efficient',
          ],
          bedrooms: 4,
          bathrooms: 3,
          area: 2500,
          mlsNumber: '995201',
      };
  }

  return {
      property,
      allImages,
      listing,
      useMetric,
      rooms,
      previousNotes,
      subscribeForm,
      visits,
      documents,
      calculatorSettings,
      coordinates,
      injectProperty,
      getLevelIcon,
      formatDate,
      subscribeToProperty,
      formatVisitDate,
  }
})
