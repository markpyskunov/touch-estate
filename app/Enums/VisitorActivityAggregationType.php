<?php

namespace App\Enums;

enum VisitorActivityAggregationType: string
{
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case ANNUALLY = 'annually';
    case ALL_TIME = 'all_time';
}
