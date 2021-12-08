<?php

namespace Main;

use Oop\Weather\Reader\BerlinReader;
use Oop\Weather\Reader\LondonReader;
use Oop\Weather\Reader\ParisReader;
use Oop\Weather\WeatherService;

require_once __DIR__.'/vendor/autoload.php';

$city = $argv[1] ?? null;
if (!$city) {
    die("NO CITY!\n");
}
$weatherService = new WeatherService([
    new ParisReader(),
    new BerlinReader(),
    new LondonReader(),
]);
$weather = $weatherService->getWeather($city);

echo sprintf("Weather for %s:\n", ucfirst($city));
echo sprintf("- Temperature: %s\n", $weather->getTemperature()->toString());
echo sprintf("- Humidity: %s\n", $weather->getHumidity()->toString());
echo sprintf("- Wind speed: %s\n", $weather->getWindSpeed()?->toString() ?: '*no data*');
