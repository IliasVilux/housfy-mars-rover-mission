<?php

namespace MarsRover;

class Obstacle
{
    public function __construct(public int $x, public int $y)
    {
    }

    public function isOccupied(int $x, int $y): bool
    {
        return $this->x === $x && $this->y === $y;
    }
}