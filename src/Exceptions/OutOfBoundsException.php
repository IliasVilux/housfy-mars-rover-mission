<?php

namespace MarsRover\Exceptions;

class OutOfBoundsException extends \Exception
{
    public function __construct(int $boundX, int $boundY, int $roverX, int $roverY)
    {
        parent::__construct("Warning: Rover has breached the planetary boundaries at coordinates ($boundX, $boundY). Abort mission. Rover halted at coordinates ($roverX, $roverY).");
    }
}