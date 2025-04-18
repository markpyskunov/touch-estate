<?php

namespace App\Enums;

enum RoomType: string
{
    case BEDROOM = 'bedroom';
    case BATHROOM = 'bathroom';
    case FLEX = 'flex';
    case DEN = 'den';
    case PARKING = 'parking';
    case GARAGE = 'garage';
    case YARD = 'yard';
}
