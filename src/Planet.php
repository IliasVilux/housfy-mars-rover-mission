<?php

namespace MarsRover;

class Planet
{
    // Array to store the obstacles generated on the planet
    private array $obstacles = [];

    /**
     * Constructor that initializes the planet with a given size (default 200x200)
     * and generates obstacles randomly.
     * 
     * @param int $size
     */
    public function __construct(public int $size=200)
    {
        $this->generateObstacles();
    }

    /**
     * Generates random obstacles on the planet.
     * The number of obstacles will be 10% of the planet's size.
     * Ensures that obstacles do not overlap.
     */
    private function generateObstacles(): void
    {
        $amountObstacles = intval($this->size * 0.1);
        $obstaclesGenerated = 0;

        while ($obstaclesGenerated < $amountObstacles) {
            $x = rand(0, $this->size - 1);
            $y = rand(0, $this->size - 1);

            // If the position is clear (no obstacles), add a new obstacle
            if ($this->isClear($x, $y)) {
                $this->obstacles[] = new Obstacle($x, $y);
                $obstaclesGenerated++;
            }
        }
    }

    /**
     * Checks if a position (x, y) is free of obstacles.
     * 
     * @param int $x
     * @param int $y
     * 
     * @return bool True if the position is clear of obstacles, false if occupied.
     */
    public function isClear(int $x, int $y): bool
    {
        foreach ($this->obstacles as $obstacle) {
            if ($obstacle->isOccupied($x, $y)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Returns an array of obstacles present on the planet.
     *
     * @return array
     */
    public function getObstacles(): array
    {
        return $this->obstacles;
    }

    /**
     * Adds a new obstacle to the planet at the specified coordinates.
     *
     * @param int $x
     * @param int $y
     */
    public function addObstacle(int $x, int $y): void
    {
        $this->obstacles[] = new Obstacle($x, $y);
    }
}