<?php

namespace App\Enums;

enum Timezone: string
{
    case America_New_York = 'America/New_York';
    case America_Chicago = 'America/Chicago';
    case America_Denver = 'America/Denver';
    case America_Los_Angeles = 'America/Los_Angeles';
    case America_Anchorage = 'America/Anchorage';
    case America_Adak = 'America/Adak';
    case America_Honolulu = 'America/Honolulu';
    case America_Phoenix = 'America/Phoenix';
    case America_Detroit = 'America/Detroit';
    case America_Indiana_Indianapolis = 'America/Indiana/Indianapolis';
    case America_Indiana_Vincennes = 'America/Indiana/Vincennes';
    case America_Indiana_Winamac = 'America/Indiana/Winamac';
    case America_Indiana_Marengo = 'America/Indiana/Marengo';
    case America_Indiana_Petersburg = 'America/Indiana/Petersburg';
    case America_Indiana_Vevay = 'America/Indiana/Vevay';
    case America_Kentucky_Louisville = 'America/Kentucky/Louisville';
    case America_Kentucky_Monticello = 'America/Kentucky/Monticello';
    case America_North_Dakota_Center = 'America/North_Dakota/Center';
    case America_North_Dakota_New_Salem = 'America/North_Dakota/New_Salem';
    case America_North_Dakota_Beulah = 'America/North_Dakota/Beulah';
    case America_Boise = 'America/Boise';
    case America_Juneau = 'America/Juneau';
    case America_Sitka = 'America/Sitka';
    case America_Metlakatla = 'America/Metlakatla';
    case America_Yakutat = 'America/Yakutat';
    case America_Nome = 'America/Nome';
    case America_St_Thomas = 'America/St_Thomas';
    case America_St_Lucia = 'America/St_Lucia';
    case America_St_Vincent = 'America/St_Vincent';
    case America_Tortola = 'America/Tortola';
    case America_St_Kitts = 'America/St_Kitts';
    case America_Grenada = 'America/Grenada';
    case America_Dominica = 'America/Dominica';
    case America_Antigua = 'America/Antigua';
    case America_Puerto_Rico = 'America/Puerto_Rico';
    case America_Anguilla = 'America/Anguilla';
    case America_Montserrat = 'America/Montserrat';
    case America_Aruba = 'America/Aruba';
    case America_Nassau = 'America/Nassau';
    case America_Barbados = 'America/Barbados';
    case America_Belize = 'America/Belize';
    case America_Cayman = 'America/Cayman';
    case America_Costa_Rica = 'America/Costa_Rica';
    case America_El_Salvador = 'America/El_Salvador';
    case America_Guatemala = 'America/Guatemala';
    case America_Managua = 'America/Managua';
    case America_Panama = 'America/Panama';
    case America_Tegucigalpa = 'America/Tegucigalpa';
    case America_Atikokan = 'America/Atikokan';
    case America_Blanc_Sablon = 'America/Blanc-Sablon';
    case America_Cambridge_Bay = 'America/Cambridge_Bay';
    case America_Creston = 'America/Creston';
    case America_Dawson = 'America/Dawson';
    case America_Dawson_Creek = 'America/Dawson_Creek';
    case America_Edmonton = 'America/Edmonton';
    case America_Fort_Nelson = 'America/Fort_Nelson';
    case America_Glace_Bay = 'America/Glace_Bay';
    case America_Goose_Bay = 'America/Goose_Bay';
    case America_Halifax = 'America/Halifax';
    case America_Inuvik = 'America/Inuvik';
    case America_Iqaluit = 'America/Iqaluit';
    case America_Moncton = 'America/Moncton';
    case America_Nipigon = 'America/Nipigon';
    case America_Pangnirtung = 'America/Pangnirtung';
    case America_Rainy_River = 'America/Rainy_River';
    case America_Rankin_Inlet = 'America/Rankin_Inlet';
    case America_Regina = 'America/Regina';
    case America_Resolute = 'America/Resolute';
    case America_St_Johns = 'America/St_Johns';
    case America_Swift_Current = 'America/Swift_Current';
    case America_Thunder_Bay = 'America/Thunder_Bay';
    case America_Toronto = 'America/Toronto';
    case America_Vancouver = 'America/Vancouver';
    case America_Whitehorse = 'America/Whitehorse';
    case America_Winnipeg = 'America/Winnipeg';
    case America_Yellowknife = 'America/Yellowknife';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function isValid(string $timezone): bool
    {
        return in_array($timezone, self::values(), true);
    }
} 