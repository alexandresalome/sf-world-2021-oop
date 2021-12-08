<?php

namespace Oop\Weather;

class TitouanClient
{
    public function getDataForCity(string $name): array
    {
        $content = file_get_contents('https://weather.titouangalopin.com/'.$name.'.json');

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }
}
