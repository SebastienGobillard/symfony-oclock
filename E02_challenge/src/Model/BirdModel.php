<?php

namespace App\Model;

abstract class BirdModel
{
    private static $birds = [
        0 => [
            'id' => 0,
            'name' => 'Rossignol',
            'height' => 16,
            'scale' => 24
        ],
        1 => [
            'id' => 1,
            'name' => 'Royal Eagle',
            'height' => 90,
            'scale' => 200
        ],
        2 => [
            'id' => 2,
            'name' => 'Pigeon',
            'height' => 25,
            'scale' => 80
        ],
    ];

    static public function getBirds(): array
    {
        return self::$birds;
    }
}