import {Address} from "@/contracts/address";
import {Campaign} from "@/contracts/campaigns";

interface LocationImage {
    id: string;
    location_id: string;
    source: string;
    order: number|null;
    created_at: string;
    updated_at: string;
}

interface LocationFeature {
    id: string;
    location_id: string;
    name: string;
    description: string|null;
    created_at: string;
    updated_at: string;
}

interface LocationPricing {
    id: string;
    location_id: string;
    price: number;
    currency: string;
    active_from: string;
    active_to: string|null;
    created_at: string;
    updated_at: string;
}

interface LocationMeta {
    id: string;
    location_id: string;
    key: string;
    value: string;
    created_at: string;
    updated_at: string;
}

interface LocationRoom {
    id: string;
    location_id: string;
    name: string;
    description: string|null;
    created_at: string;
    updated_at: string;
}

interface NfcQrTag {
    id: string;
    location_id: string;
    name: string;
    code: string;
    created_at: string;
    updated_at: string;
}

/**
 * Represents a property with all its associated data
 */
export interface Property {
    id: string;
    name: string;
    address: Address;
    location_images: LocationImage[];
    features: LocationFeature[];
    pricing: LocationPricing;
    meta: LocationMeta[];
    rooms: LocationRoom[];
    nfc_qr_tags: NfcQrTag[];
    campaign: Campaign;
    created_at: string;
    updated_at: string;
}
