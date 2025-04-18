import {Address} from "@/contracts/address";
import {Campaign} from "@/contracts/campaigns";
import {VisitSource} from "@/stores/visit";

interface LocationImage {
    id: string;
    location_id: string;
    source: string;
    order: number|null;
    is_default: boolean;
    is_featured: boolean;
}

interface LocationFeature {
    id: string;
    feature: string;
    value: boolean|number|string;
}

interface LocationPricing {
    id: string;
    location_id: string;
    price_before: number;
    price_after: number;
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

export interface LocationRoom {
    id: string;
    level: number;
    name: string;
    area_sqft: number;
    width_ft: string;
    length_ft: string;
    width_meters: string;
    length_meters: string;
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

interface LocationDocument {
    id: string;
    name: string;
    url: string;
    size: string;
    icon: string;
    icon_color: string;
}

interface LocationNote {
    id: string;
    note: string;
    created_at: string;
    updated_at: string;
}

export type VisitSource =
    | 'website'
    | 'qr'
    | 'nfc'
    | 'unknown'

interface VisitorVisit {
    created_at: string;
    type: VisitSource;
}

export interface Property {
    id: string;
    name: string;
    mls: string;
    area_sqft: null|number;
    description: null|string;
    address: Address;
    location_images: LocationImage[];
    features: LocationFeature[];
    pricing: LocationPricing;
    meta: LocationMeta[];
    rooms: LocationRoom[];
    nfc_qr_tags: NfcQrTag[];
    documents: LocationDocument[];
    notes: LocationNote[];
    visits: VisitorVisit[];
    campaign: Campaign;
    is_favorite: boolean;
    stats: {
        visitors: number;
        favorites: number;
    },
    created_at: string;
    updated_at: string;
}
