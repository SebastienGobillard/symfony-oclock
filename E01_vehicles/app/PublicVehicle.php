<?php

namespace VehiclesApp;

use VehiclesApp\Vehicle;

abstract class PublicVehicle extends Vehicle
{
    public $capacity;
    public $mediumPrice;

    public function getTotalPrice() {
        return $this->capacity * $this->mediumPrice;
    }
}