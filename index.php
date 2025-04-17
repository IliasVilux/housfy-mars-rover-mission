<?php

require __DIR__ . '/vendor/autoload.php';

use MarsRover\Planet;
use MarsRover\Rover;

$planet = new Planet(50);
$rover = new Rover(0, 1, "N", $planet);
$rover->move("FFRRFFFRL");