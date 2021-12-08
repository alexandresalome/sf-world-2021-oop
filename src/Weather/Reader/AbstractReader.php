<?php

namespace Oop\Weather\Reader;

use Oop\Weather\Humidity;
use Oop\Weather\Temperature;
use Oop\Weather\TitouanClient;
use Oop\Weather\Weather;
use Oop\Weather\WindSpeed;

abstract class AbstractReader implements ReaderInterface
{
    public function read(): Weather
    {
        $client = new TitouanClient();
        $data = $client->getDataForCity($this->getName());

        foreach ($this->getNestedArrays() as $key) {
            $data = $data[$key];
        }

        $temperatureKey = $this->getTemperatureKey();
        $value = $data[$temperatureKey];
        $temperature = Temperature::celcius($value);

        $humidityKey = $this->getHumidityKey();
        $value = $data[$humidityKey];
        $humidity = new Humidity($value);

        $windKey = $this->getWindKey();
        $value = $data[$windKey] ?? null;
        $wind = $value === null ? null : new WindSpeed($value, $this->getWindSpeedSystem());

        return new Weather($temperature, $humidity, $wind);
    }

    /** @return string[] */
    protected function getNestedArrays(): array
    {
        return [];
    }

    protected function getTemperatureKey(): string
    {
        return 'temperature';
    }

    protected function getHumidityKey(): string
    {
        return 'humidity';
    }

    protected function getWindKey(): string
    {
        return 'wind';
    }

    protected function getWindSpeedSystem(): string
    {
        return 'km/h';
    }
}
