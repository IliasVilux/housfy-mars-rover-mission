<?php

namespace MarsRover\Exceptions;

class InvalidStartingPositionException extends \Exception
{
    public function __construct(int $x, int $y, ?int $planetSize = null)
    {
        if ($planetSize !== null) {
            parent::__construct("Invalid starting position: Coordinates ($x, $y) are outside the boundaries of the planet.");
        } else {
            parent::__construct("Invalid starting position: An obstacle is present at coordinates ($x, $y).");
        }
    }
}