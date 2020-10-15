<?php

namespace VehiclesApp;

abstract class Vehicle
{
    public $speed;

    public function showSpeed()
    {
        echo "<p>" . get_called_class() . " se déplace à " . $this->speed . "km/h.</p>";
    }

    abstract function move();
}