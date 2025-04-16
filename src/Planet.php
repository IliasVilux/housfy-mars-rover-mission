<?php

namespace MarsRover;

class Planet
{
    public array $obstacles = [];

    public function __construct(public int $size=200)
    {
        $this->generateObstacles();
    }

    private function generateObstacles(): void
    {
        $amountObstacles = intval($this->size * 0.1);
        $obstaclesGenerated = 0;

        while ($obstaclesGenerated < $amountObstacles) {
            $x = rand(0, $this->size - 1);
            $y = rand(0, $this->size - 1);

            if ($this->canCreate($x, $y)) {
                $this->obstacles[] = new Obstacle($x, $y);
                $obstaclesGenerated++;
            }
        }
    }

    public function canCreate(int $x, int $y): bool
    {
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle->isOccupied($x, $y)) {
                return false;
            }
        }
        return true;
    }
}