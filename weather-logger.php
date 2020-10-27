<?php
declare(strict_types=1);

namespace App;

use App\Datamodel\Location;
use App\WeatherInformer;
use App\Providers\WeatherDataFormat;

require __DIR__ . '/vendor/autoload.php';
    
$informer = new WeatherInformer(App::getWeatherProvider(), App::getFileService());

$location = new Location(55.833333, 37.616667); // Moscow
$informer->addLocation($location, WeatherDataFormat::JSON);
$informer->addLocation($location, WeatherDataFormat::XML);

$informer->watchWeather();
