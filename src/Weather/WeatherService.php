<?php

namespace Oop\Weather;

use Oop\Weather\Reader\ReaderInterface;

class WeatherService
{
    /** @var ReaderInterface[] */
    private array $readers = [];

    /**
     * @param ReaderInterface[] $readers
     */
    public function __construct(array $readers)
    {
        foreach ($readers as $reader) {
            $this->readers[$reader->getName()] = $reader;
        }
    }

    public function getWeather(string $cityName): Weather
    {
        if (!isset($this->readers[$cityName])) {
            throw new \RuntimeException(sprintf(
                'No weather for city "%s". Available are: %s.',
                $cityName,
                implode(', ', array_keys($this->readers))
            ));
        }

        return $this->readers[$cityName]->read();
    }
}
