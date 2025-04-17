<?php

namespace MarsRover\Exceptions;

class ObstacleEncounteredException extends \Exception
{
    public function __construct(int $obstacleX, int $obstacleY, int $roverX, int $roverY)
    {
        parent::__construct("Obstáculo detectado en coordenadas ($obstacleX, $obstacleY). Movimiento abortado. Rover se ha detenido en las coordenadas ($roverX, $roverY)");
    }
}