<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\INetworkService;
use App\Datamodel\Location;
use App\Datamodel\Weather;

/**
 * Provides weather from Yandex API
 * Based on API documentation:
 * https://yandex.ru/dev/weather/doc/dg/concepts/forecast-test.html
 */
class YandexWeatherProvider implements IWeatherProvider
{
    /**
     * @var INetworkService
     */
    private $networkService;
    
    private const BASE_URL = 'https://api.weather.yandex.ru/v2/forecast';
    
    /**
     * @var array [string => mixed]
     */
    private $params;
    
    private $headers = [
        'X-Yandex-API-Key: ' . APP_KEY,
        
    ];

    function __construct(INetworkService $networkService, array $params)
    {
        $this->networkService = $networkService;
        $this->params = $params;
    }
    
    /**
     * Provides the current weather for a specific location
     * 
     * @param Location $location
     * @return Weather
     */
    public function getCurrentWeather(Location $location): Weather
    {
        $this->params['lat'] = $location->getLatitude();
        $this->params['lon'] = $location->getLongitude();

        $response = $this->networkService->makeGetRequest(
                self::BASE_URL,
                $this->params,
                $this->headers
        );
        $rawWeatherData = json_decode($response, true);
        
        return $this->convertRawData($rawWeatherData);
    }
    
    private function convertRawData(array $rawWeatherData): Weather
    {
        $result = new Weather();
        
        $result->city = $rawWeatherData['info']['tzinfo']['name'];
        $result->dateTime = $rawWeatherData['now_dt'];
        $fact = $rawWeatherData['fact'];
        
        $result->airTemperature = $fact['temp'];
        $result->feelsLike = $fact['feels_like'];
        $result->waterTemperature = $fact['temp_water'];
        $result->weatherCondition = YandexWeatherDictionary::CONDITIONS[$fact['condition']];
        $result->windSpeed = $fact['wind_speed'];
        $result->windGust = $fact['wind_gust'];
        $result->windDirection = YandexWeatherDictionary::WIND_DIRECTIONS[$fact['wind_dir']];
        $result->pressure = $fact['pressure_mm'];
        $result->humidity = $fact['humidity'];
        // Temporarily disabled. Server response does not match the API documentation.
        // $result->isThunder = $fact['is_thunder'];
        // Temporarily disabled. Server response does not match the API documentation.
        // $result->precipitationType = YandexWeatherDictionary::PRECIPITATION_TYPES[$fact['prec_type']];
        // Temporarily disabled. Server response does not match the API documentation.
        // $result->precipitationStrength = $fact['prec_strength'];
        // Temporarily disabled. Server response does not match the API documentation.
        // $result->cloudness = YandexWeatherDictionary::CLOUDNESS[$fact['cloudness']];
        // Temporarily disabled. Server response does not match the API documentation.
        // $result->phenomen = YandexWeatherDictionary::PHENOMENS[$fact['phenom-condition']];
        
        return $result;
    }
}
