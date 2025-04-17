<?php

namespace MarsRover;

class Obstacle
{
    /**
     * Constructor to initialize the obstacle's coordinates (x, y).
     * 
     * @param int $x
     * @param int $y
     */
    public function __construct(public int $x, public int $y)
    {
    }

    /**
     * Checks if the given coordinates match the position of the obstacle.
     * 
     * @param int $x
     * @param int $y
     * 
     * @return bool
     */
    public function isOccupied(int $x, int $y): bool
    {
        return $this->x === $x && $this->y === $y;
    }
}