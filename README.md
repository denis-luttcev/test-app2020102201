# Test Application 2020102201

This application is designed to monitoring the current weather for specified locations.

## Install

This application was built for Composer. Visit https://getcomposer.org/ for install and configure it.

This application requires an access token to the Yandex.Weather service.
Visit https://yandex.ru/dev/weather/doc/dg/concepts/about.html/ to select a tariff and get a key.
Put access token into `app-key.php` file: 
    define('APP_KEY', 'put your Yandex.Weather key here');

For correctly application work the following extensions must be enabled into your 'php.ini':
    extension=openssl
    extension=curl

## Use

To use the application you can run script 'weather-logger.php' from CLI, on build-in server or localhost.

For regular watching use a sheduler (for example 'сron') for run script.

Change watched locations into script's body by sample:
    $location = new Location(55.833333, 37.616667); // Moscow
    $informer->addLocation($location, WeatherDataFormat::JSON);

The watching takes place by geo-coordinates (latitude, longitude), expressed in decimal degrees.

## Result

The application saves data into JSON or XML formats (See output samples).

Output files are placed into default 'output' directory.
You can change it into 'App.php' by sample:
    const OUTPUT_DIR = '/../output/';

In the output directory files are categorized by location name (like 'Europe/Moscow/').
File names are date and time (UTC) then data was providing.
