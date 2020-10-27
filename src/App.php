<?php
declare(strict_types=1);

namespace App;

use App\Services\INetworkService;
use App\Services\CurlBasedHttpClient;
use App\Services\IFileService;
use App\Services\FileServiceImpl;
use App\Providers\IWeatherProvider;
use App\Providers\YandexWeatherBuilder;
use App\Providers\Language;

/**
 * DI container
 */
class App
{
    const OUTPUT_DIR = '/../output/';

    /**
     * @var IFileService?
     */
    private static $fileService = null;
    
    public static function getNetworkService(): INetworkService
    {
        return CurlBasedHttpClient::getInstance();
    }
    
    public static function getFileService(): IFileService
    {
        if (!is_null(self::$fileService)) {
            return self::$fileService;
        } else {
            return new FileServiceImpl(__DIR__ . self::OUTPUT_DIR);
        }
    }
    
    public static function getWeatherProvider(): IWeatherProvider
    {
        return YandexWeatherBuilder::newInstance(self::getNetworkService())
                ->setResponseLanguage(Language::RU)
                ->setHoursForecast(false)
                ->build();
    }
}
