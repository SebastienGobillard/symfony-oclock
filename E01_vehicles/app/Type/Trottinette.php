<?php

namespace VehiclesApp\Type;

use VehiclesApp\Vehicle;

class Trottinette extends Vehicle
{
    public function move() {
        echo __CLASS__ . "has moved !";
    }
}