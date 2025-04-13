type Language = "en" | "es" | "fr";

type Flag = 
    | "is_active"
    | "is_public"
    | "requires_authentication"
    | "collects_contact_info"
    | "sends_notifications"
    | "has_custom_theme"
    | "supports_multiple_languages"
    | "has_analytics";

interface CampaignPayload {
    id: string;
    name: string;
    flags: Record<Flag, boolean>;
    i18n: Record<Language, Record<string, string>>;
}

interface LocationFeature {
    id: string;
    location_id: string;
    feature: string;
    value: string;
    created_at: Date;
    updated_at: Date;
}

export type { Language, Flag, CampaignPayload, LocationFeature }; 