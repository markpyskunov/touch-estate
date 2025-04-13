<?php

namespace App\Enums;

enum LocationFeatureName: string
{
    case WATERFRONT = 'waterfront';
    case DOWNTOWN = 'downtown';
    case PARKING = 'parking';
    case PUBLIC_TRANSIT = 'public_transit';
    case WALK_SCORE = 'walk_score';
    case BIKE_SCORE = 'bike_score';
    case TRANSIT_SCORE = 'transit_score';
}
