<?php

namespace MarsRover\Exceptions;

class OutOfBoundsException extends \Exception
{
    public function __construct(int $boundX, int $boundY, int $roverX, int $roverY)
    {
        parent::__construct("El Rover ha salido del planeta en ($boundX, $boundY). Movimiento abortado. Rover se ha detenido en las coordenadas ($roverX, $roverY)");
    }
}