<?php

require 'vendor/autoload.php';

use VehiclesApp\Type\Bike;
use VehiclesApp\Type\Car;
use VehiclesApp\Type\Plane;
use VehiclesApp\Type\Tram;
use VehiclesApp\Type\Trottinette;

$bike = new Bike();
$bike->speed = 15;
$bike->showSpeed();
$bike->warn();

$car = new Car();
$car->speed = 90;
$car->showSpeed();
$car->warn();

$plane = new Plane();
$plane->speed = 800;
$plane->showSpeed();

$tram = new Tram();
$tram->speed = 40;
$tram->showSpeed();
$tram->warn();

$trottinette = new Trottinette();
$trottinette->speed = 20;
$trottinette->showSpeed();
