import { PrismaClient } from '@prisma/client';
import { faker } from '@faker-js/faker';

const prisma = new PrismaClient();

const locations = [
  {
    name: 'Victoria Waterfront',
    description: 'Stunning waterfront property in downtown Victoria with panoramic ocean views.',
    address: '1000 Wharf St, Victoria, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: true,
      walkScore: 95,
      bikeScore: 90,
      transitScore: 85
    },
    locationPricing: {
      averageHomePrice: 1200000,
      averageRent: 2500,
      propertyTaxRate: 0.5,
      pricePerSquareFoot: 800
    }
  },
  {
    name: 'Saanich Peninsula',
    description: 'Quiet suburban neighborhood with excellent schools and family-friendly amenities.',
    address: '7800 East Saanich Rd, Saanichton, BC',
    locationFeatures: {
      waterfront: false,
      downtown: false,
      parking: true,
      publicTransit: true,
      walkScore: 65,
      bikeScore: 75,
      transitScore: 70
    },
    locationPricing: {
      averageHomePrice: 950000,
      averageRent: 2000,
      propertyTaxRate: 0.45,
      pricePerSquareFoot: 650
    }
  },
  {
    name: 'Oak Bay',
    description: 'Upscale residential area known for its heritage homes and ocean views.',
    address: '2200 Oak Bay Ave, Victoria, BC',
    locationFeatures: {
      waterfront: true,
      downtown: false,
      parking: true,
      publicTransit: true,
      walkScore: 85,
      bikeScore: 80,
      transitScore: 75
    },
    locationPricing: {
      averageHomePrice: 1500000,
      averageRent: 3000,
      propertyTaxRate: 0.55,
      pricePerSquareFoot: 900
    }
  },
  {
    name: 'Langford',
    description: 'Fast-growing community with modern amenities and easy access to Victoria.',
    address: '2625 Peatt Rd, Langford, BC',
    locationFeatures: {
      waterfront: false,
      downtown: false,
      parking: true,
      publicTransit: true,
      walkScore: 60,
      bikeScore: 70,
      transitScore: 65
    },
    locationPricing: {
      averageHomePrice: 850000,
      averageRent: 1800,
      propertyTaxRate: 0.4,
      pricePerSquareFoot: 550
    }
  },
  {
    name: 'Sidney',
    description: 'Charming seaside town with a vibrant downtown and marina.',
    address: '2425 Beacon Ave, Sidney, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: true,
      walkScore: 80,
      bikeScore: 75,
      transitScore: 70
    },
    locationPricing: {
      averageHomePrice: 900000,
      averageRent: 1900,
      propertyTaxRate: 0.45,
      pricePerSquareFoot: 600
    }
  },
  {
    name: 'Cowichan Valley',
    description: 'Rural area known for its wineries and agricultural land.',
    address: '2000 Cowichan Bay Rd, Cowichan Bay, BC',
    locationFeatures: {
      waterfront: true,
      downtown: false,
      parking: true,
      publicTransit: false,
      walkScore: 40,
      bikeScore: 50,
      transitScore: 30
    },
    locationPricing: {
      averageHomePrice: 750000,
      averageRent: 1600,
      propertyTaxRate: 0.35,
      pricePerSquareFoot: 450
    }
  },
  {
    name: 'Nanaimo Harbour',
    description: 'Central location with ferry access and growing downtown core.',
    address: '100 Front St, Nanaimo, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: true,
      walkScore: 75,
      bikeScore: 70,
      transitScore: 65
    },
    locationPricing: {
      averageHomePrice: 800000,
      averageRent: 1700,
      propertyTaxRate: 0.4,
      pricePerSquareFoot: 500
    }
  },
  {
    name: 'Parksville',
    description: 'Popular retirement and vacation destination with beautiful beaches.',
    address: '100 Jensen Ave E, Parksville, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: true,
      walkScore: 70,
      bikeScore: 65,
      transitScore: 60
    },
    locationPricing: {
      averageHomePrice: 700000,
      averageRent: 1500,
      propertyTaxRate: 0.35,
      pricePerSquareFoot: 400
    }
  },
  {
    name: 'Comox Valley',
    description: 'Mountain and ocean views with excellent outdoor recreation opportunities.',
    address: '1800 Beaufort Ave, Comox, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: true,
      walkScore: 65,
      bikeScore: 70,
      transitScore: 60
    },
    locationPricing: {
      averageHomePrice: 750000,
      averageRent: 1600,
      propertyTaxRate: 0.35,
      pricePerSquareFoot: 450
    }
  },
  {
    name: 'Tofino',
    description: 'World-renowned surf town with stunning Pacific Ocean views.',
    address: '120 4th St, Tofino, BC',
    locationFeatures: {
      waterfront: true,
      downtown: true,
      parking: true,
      publicTransit: false,
      walkScore: 85,
      bikeScore: 75,
      transitScore: 40
    },
    locationPricing: {
      averageHomePrice: 1100000,
      averageRent: 2200,
      propertyTaxRate: 0.45,
      pricePerSquareFoot: 700
    }
  }
];

export async function seedLocations() {
  try {
    for (const location of locations) {
      await prisma.location.create({
        data: {
          name: location.name,
          description: location.description,
          address: location.address,
          locationFeatures: location.locationFeatures,
          locationPricing: location.locationPricing,
          locationImage: faker.image.urlLoremFlickr({ category: 'building' })
        }
      });
    }
    console.log('✅ Locations seeded successfully');
  } catch (error) {
    console.error('Error seeding locations:', error);
    throw error;
  }
} 