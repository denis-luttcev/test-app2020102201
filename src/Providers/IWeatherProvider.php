<?php
declare(strict_types=1);

namespace App\Providers;

use App\Datamodel\Location;
use App\Datamodel\Weather;

/**
 * API for provide weather data from external source
 */
interface IWeatherProvider
{
    function getCurrentWeather(Location $location): Weather;
}
