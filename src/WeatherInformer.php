<?php
declare(strict_types=1);

namespace App;

use App\Datamodel\Location;
use App\Datamodel\WeatherSerializer;
use App\Services\IFileService;
use App\Providers\IWeatherProvider;
use App\Providers\WeatherDataFormat;

/**
 * Description of WeatherInformer
 */
class WeatherInformer
{
    /**
     * @var IWeatherProvider;
     */
    private $weatherProvider;
    /**
     * @var IFileService
     */
    private $fileService;
    
    /**
     * List of watching locations
     * 
     * @var list ['place' =>Location, 'format' => WeatherDataFormat]
     */
    private $locations;


    public function __construct(
            IWeatherProvider $weatherProvider,
            IFileService $fileService
    ) {
        $this->weatherProvider = $weatherProvider;
        $this->fileService = $fileService;
    }
    
    public function addLocation(Location $location, string $format): void
    {
        $this->locations[] = ['place' => $location, 'format' => $format, ];
    }

    public function watchWeather(): void
    {
        foreach ($this->locations as $location) {
            $weather = $this->weatherProvider->getCurrentWeather($location['place']);
            $city = $weather->city;
            $dateTime = $this->prepareAsFilename($weather->dateTime);
            $fullFilename = "$city/$dateTime.{$location['format']}";

            switch ($location['format']) {
                case WeatherDataFormat::JSON:
                    $content = WeatherSerializer::toJson($weather);
                    break;
                case WeatherDataFormat::XML:
                    $content = WeatherSerializer::toXml($weather);
                    break;
                default:
                    return;
            }

            $this->fileService->save($content, $fullFilename);    
        }
    }
    
    private function prepareAsFilename(string $dateTime): string
    {
        return str_replace([':', '.', ], ['-', '-', ], $dateTime);
    }
}
