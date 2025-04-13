<?php

namespace App\Enums;

enum LocationMetaKey: string
{
    case PROPERTY_TYPE = 'property_type';
    case BUILDING_TYPE = 'building_type';
    case NEIGHBOURHOOD_NAME = 'neighbourhood_name';
    case TITLE = 'title';
    case BUILT_IN = 'built_in';
    case ANNUAL_PROPERTY_TAXES = 'annual_property_taxes';
    case PARKING_TYPE = 'parking_type';
    case PARKING_LOTS = 'parking_lots';
    case BEDROOMS = 'bedrooms';
    case BATHROOMS = 'bathrooms';
    case SQUARE_FOOTAGE = 'square_footage';
    case LAND_SIZE = 'land_size';
    case UNIQUE_BUILDING_FEATURE = 'unique_building_feature';
    case HEATING_COOLING = 'heating_cooling';
    case UNIQUE_NEIGHBOURHOOD_FEATURES = 'unique_neighbourhood_features';
    case MAINTENANCE_FEE_PRICE = 'maintenance_fee_price';
    case MAINTENANCE_FEE_INFO = 'maintenance_fee_info';
    case OTHER_LAND_FEATURE = 'other_land_feature';
} 