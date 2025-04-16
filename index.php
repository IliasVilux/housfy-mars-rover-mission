<?php

require __DIR__ . '/vendor/autoload.php';

use MarsRover\Planet;
use MarsRover\Rover;

$planet = new Planet();
echo "Planeta creado! Tiene un tamaño de {$planet->size} \n";
echo "Obstáculos generados:\n";
foreach ($planet->obstacles as $index => $obstacle) {
    echo "- Obstáculo #$index en posición ({$obstacle->x}, {$obstacle->y})\n";
}
$rover = new Rover();
echo "Rover creado!";