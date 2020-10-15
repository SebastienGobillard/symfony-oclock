<?php

namespace VehiclesApp\Type;

use VehiclesApp\Vehicle;
use VehiclesApp\Features\Warn;

class Car extends Vehicle implements Warn
{
    public function move() {
        echo __CLASS__ . "has moved !";
    }

    public function warn() {
        echo "Tut tut!";
    }
}