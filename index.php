<?php

require __DIR__ . '/vendor/autoload.php';

use MarsRover\Planet;
use MarsRover\Rover;

$planet = new Planet();
$rover = new Rover();
$rover->move();