export interface Address {
    id: string;
    place_id: string;
    formatted_address: string;
    street_number: string|null;
    route: string|null;
    locality: string|null;
    administrative_area_level_1: string|null;
    administrative_area_level_2: string|null;
    country: string|null;
    postal_code: string|null;
    latitude: number|null;
    longitude: number|null;
    address_components: string[]|null;
    types: string[]|null;
    viewport: string[]|null;
    geometry: string[]|null;
    created_at: string;
    updated_at: string;
}
