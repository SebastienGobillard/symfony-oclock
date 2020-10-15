<?php

namespace VehiclesApp;

use VehiclesApp\Vehicle;

abstract class PrivateVehicule extends Vehicle
{
    public $brand;
    public $consumption;

    public function getConsuption() {
        return $this->consumption;
    }
}