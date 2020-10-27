<?php
declare(strict_types=1);

namespace App\Datamodel;

use App\Datamodel\Weather;
use DOMDocument;

/**
 * Converts Weather to output formats
 */
class WeatherSerializer
{
    /**
     * Presents weather data in JSON format
     * 
     * @param Weather $weather
     * @return string JSON representation
     */
    public static function toJson(Weather $weather): string
    {
        $output = [];
        
        // reorganizing the properties in the order specified for JSON out according the test task
        $output['date'] = $weather->dateTime;
        $output['temp'] = $weather->airTemperature . '°С';
        $output['wind_dir'] = $weather->windDirection;
        $output['wind_speed'] = $weather->windSpeed . ' м/с';
        $output['wind_gust'] = $weather->windGust . ' м/с';
        $output['pressure'] = $weather->pressure . ' мм рт. ст.';
        $output['humidity'] = $weather->humidity . '%';
        $output['feels_like'] = $weather->feelsLike . '°С';
        $output['condition'] = $weather->weatherCondition;
        $output['water_temp'] = $weather->waterTemperature . '°С';
        //TODO: add properties temporarily disabled in the model
        
        return json_encode(
                $output,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );
    }
    
    /**
     * Presents weather data in XML format
     * 
     * @param Weather $weather
     * @return string XML representation
     */
    public static function toXml(Weather $weather): string
    {
        $output = new DOMDocument('1.0','utf-8');
        $root = $output->appendChild($output->createElement('weather'));
        
        //reorganizing the properties in the order specified for XNL out according the test task
        $root->appendChild($output->createElement('date', $weather->dateTime));
        $root->appendChild($output->createElement('wind_speed', $weather->windSpeed . ' м/с'));
        $root->appendChild($output->createElement('temp', $weather->airTemperature . '°С'));
        $root->appendChild($output->createElement('wind_dir', $weather->windDirection));
        $root->appendChild($output->createElement('wind_gust', $weather->windGust . ' м/с'));
        $root->appendChild($output->createElement('pressure', $weather->pressure . ' мм рт. ст.'));
        $root->appendChild($output->createElement('humidity', $weather->humidity . '%'));
        $root->appendChild($output->createElement('feels_like', $weather->feelsLike . '°С'));
        $root->appendChild($output->createElement('condition', $weather->weatherCondition));
        $root->appendChild($output->createElement('water_temp', $weather->waterTemperature . '°С'));
        //TODO: add properties temporarily disabled in the model
        
        $output->formatOutput = true;
        
        return $output->saveXML();
    }
}
