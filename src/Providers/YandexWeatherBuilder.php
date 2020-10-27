<?php
declare(strict_types=1);

namespace App\Providers;

use App\Services\INetworkService;

/**
 * Creates YandexWeatherProvider instance with custom setttings
 */
class YandexWeatherBuilder
{
    /**
     * @var INetworkService
     */
    private $networkService;

    /**
     * @var array [string => mixed]
     */
    private $params = [
        'lang' => Language::EN,
        'limit' => 0,
        'hours' => true,
        'extra' => false,
        
    ];
    
    private function __construct(INetworkService $networkService)
    {
        $this->networkService = $networkService;
    }

    public static function newInstance(INetworkService $networkService): YandexWeatherBuilder
    {
        return new YandexWeatherBuilder($networkService);
    }
    
    public function setResponseLanguage(string $responseLanguage): YandexWeatherBuilder
    {
        $this->params['lang'] = $responseLanguage;
        return $this;
    }

    public function setForecastLimit(int $forecastLimit): YandexWeatherBuilder
    {
        $this->params['limit'] = $forecastLimit;
        return $this;
    }

    public function setHoursForecast(bool $hoursForecast): YandexWeatherBuilder
    {
        $this->params['hours'] = $hoursForecast;
        return $this;
    }

    public function setExtraPrecipitationInfo(bool $extraPrecipitationInfo): YandexWeatherBuilder
    {
        $this->params['extra'] = $extraPrecipitationInfo;
        return $this;
    }
    
    public function build(): YandexWeatherProvider
    {
        return new YandexWeatherProvider($this->networkService, $this->params);
    }
}
