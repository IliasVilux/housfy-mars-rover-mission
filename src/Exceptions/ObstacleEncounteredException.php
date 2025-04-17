<?php

namespace MarsRover\Exceptions;

class ObstacleEncounteredException extends \Exception
{
    public function __construct(int $obstacleX, int $obstacleY, int $roverX, int $roverY)
    {
        parent::__construct("Alert: Obstacle detected at coordinates ($obstacleX, $obstacleY). Mission aborted. Rover stopped at coordinates ($roverX, $roverY).");
    }
}