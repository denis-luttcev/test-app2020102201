<?php
declare(strict_types=1);

namespace App\Providers;

/**
 * Declares decoding of weather abbreviations
 * Based on response description from API docs:
 * https://yandex.ru/dev/weather/doc/dg/concepts/forecast-test.html#resp-format__fact
 */
class YandexWeatherDictionary
{
    const CONDITIONS = [
        'clear' => 'ясно',
        'partly-cloudy' => 'малооблачно',
        'cloudy' => 'облачно с прояснениями',
        'overcast' => 'пасмурно',
        'drizzle' => 'морось',
        'light-rain' => 'небольшой дождь',
        'rain' => 'дождь',
        'moderate-rain' => 'умеренно сильный дождь',
        'heavy-rain' => 'сильный дождь',
        'continuous-heavy-rain' => 'длительный сильный дождь',
        'showers' => 'ливень',
        'wet-snow' => 'дождь со снегом',
        'light-snow' => 'небольшой снег',
        'snow' => 'снег',
        'snow-showers' => 'снегопад',
        'hail' => 'град',
        'thunderstorm' => 'гроза',
        'thunderstorm-with-rain' => 'дождь с грозой',
        'thunderstorm-with-hail' => 'гроза с градом',
        
    ];
    
    const WIND_DIRECTIONS = [
        'nw' => 'северо-западный',
        'n' => 'северный',
        'ne' => 'северо-восточный',
        'e' => 'восточный',
        'se' => 'юго-восточный',
        's' => 'южный',
        'sw' => 'юго-западный',
        'w' => 'западный',
        'с' => 'штиль',
        
    ];
    
    const PRECIPITATION_TYPES = [
        0 => 'без осадков',
        1 => 'дождь',
        2 => 'дождь со снегом',
        3 => 'снег',
        4 => 'град',
        
    ];
    
    const CLOUDNESS = [
        0 => 'ясно',
        0.25 => 'малооблачно',
        0.5 => 'облачно с прояснениями',
        0.75 => 'облачно с прояснениями',
        1 => 'пасмурно',
        
    ];
    
    const PHENOMENS = [
        'fog' => 'туман',
        'mist' => 'дымка',
        'smoke' => 'смог',
        'dust' => 'пыль',
        'dust-suspension' => 'пылевая взвесь',
        'duststorm' => 'пыльная буря',
        'thunderstorm-with-duststorm' => 'пыльная буря с грозой',
        'drifting-snow' => 'слабая метель',
        'blowing-snow' => 'метель',
        'ice-pellets' => 'ледяная крупа',
        'freezing-rain' => 'ледяной дождь',
        'tornado' => 'торнадо',
        'volcanic-ash' => 'вулканический пепел',
        
    ];
}
