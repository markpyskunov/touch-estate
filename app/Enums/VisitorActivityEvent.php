<?php

namespace App\Enums;

enum VisitorActivityEvent: string
{
    case SOURCE_QR = 'source_qr'; // Entering via source QR
    case SOURCE_NFC = 'source_nfc'; // Entering via source NFC
    case SOURCE_WEB = 'source_web'; // Entering via source Web
    case DROP_OFF = 'drop_off'; // on leave auth page event
    case COLLECTED_DATA_POINT = 'collected_data_point'; // collected email or phone
    case VISIT = 'visit'; // accessed property page
    case ENGAGEMENT_LVL1 = 'engagement_lvl1'; // 5 mins being on page
    case ENGAGEMENT_LVL2 = 'engagement_lvl2'; // 15 mins being on page
    case ENGAGEMENT_LVL3 = 'engagement_lvl3'; // 60 mins being on page
    case LIKE = 'like';
    case SUBSCRIBE = 'subscribe';
}
