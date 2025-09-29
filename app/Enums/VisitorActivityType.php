<?php

namespace App\Enums;

enum VisitorActivityType: string
{
    case AUTH = 'auth';
    case DATA_POINT = 'data_point';
    case VISITS = 'visits';
    case ENGAGEMENT = 'engagement';
    case MORTGAGE = 'mortgage';
}
