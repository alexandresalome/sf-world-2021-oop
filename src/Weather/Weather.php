<?php

namespace Oop\Weather;

class Weather
{
    private Temperature $temperature;
    private Humidity $humidity;
    private ?WindSpeed $windSpeed;

    public function __construct(Temperature $temperature, Humidity $humidity, ?WindSpeed $windSpeed = null)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->windSpeed = $windSpeed;
    }

    public function getTemperature(): Temperature
    {
        return $this->temperature;
    }

    public function getHumidity(): ?Humidity
    {
        return $this->humidity;
    }

    public function getWindSpeed(): ?WindSpeed
    {
        return $this->windSpeed;
    }
}
