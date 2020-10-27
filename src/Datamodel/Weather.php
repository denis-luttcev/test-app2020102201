<?php
declare(strict_types=1);

namespace App\Datamodel;

/**
 * Declares weather data
 */
class Weather
{
    /**
     * @var string
     */
    public $city;
    /**
     * String representation of the UTC of receiving weather data
     * 
     * @var string
     */
    public $dateTime;
    /**
     * Celsius degrees
     * 
     * @var float
     */
    public $airTemperature;
    /**
     * Celsius degrees
     * 
     * @var float
     */
    public $feelsLike;
    /**
     * Celsius degrees
     * 
     * @var float
     */
    public $waterTemperature;
    /**
     * @var string
     */
    public $weatherCondition;
    /**
     * Meters per second
     * 
     * @var float
     */
    public $windSpeed;
    /**
     * Meters per second
     * 
     * @var float
     */
    public $windGust;
    /**
     * @var string
     */
    public $windDirection;
    /**
     * Mm Hg
     * 
     * @var float
     */
    public $pressure;
    /**
     * Percents
     * 
     * @var float
     */
    public $humidity;
    /**
     * Temporarily disabled. Server response does not match the API documentation.
     * 
     * @var bool
     */
    // public $isThunder;
    /**
     * Temporarily disabled. Server response does not match the API documentation.
     * 
     * @var string
     */
    // public $precipitationType;
    /**
     * Temporarily disabled. Server response does not match the API documentation.
     * 
     * Mm precipitations
     * 
     * @var float
     */
    // public $precipitationStrength;
    /**
     * Temporarily disabled. Server response does not match the API documentation.
     * 
     * @var string
     */
    // public $cloudness;
    /**
     * Temporarily disabled. Server response does not match the API documentation.
     * 
     * @var string
     */
    // public $phenomen;
}
