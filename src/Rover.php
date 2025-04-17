<?php

namespace MarsRover;
use MarsRover\Exceptions\InvalidStartingPositionException;
use MarsRover\Exceptions\OutOfBoundsException;
use MarsRover\Exceptions\ObstacleEncounteredException;

class Rover
{
    /**
     * Constructor that initializes the rover's position and direction.
     * 
     * @param int $x
     * @param int $y
     * @param string
     * @param Planet
     * 
     * @throws InvalidStartingPositionException
     * @throws \InvalidArgumentException
     */
    public function __construct(public int $x = 45, public int $y = 115, public string $direction = "N", private Planet $planet)
    {
        $direction = strtoupper($direction);
        $validDirections = ['N', 'S', 'E', 'W'];

        // Check if the starting position is within the planet bounds
        if ($x < 0 || $x >= $planet->size || $y < 0 || $y >= $planet->size)
        {
            throw new InvalidStartingPositionException($x, $y, $planet->size);
        }

        if (!in_array($direction, $validDirections))
        {
            throw new \InvalidArgumentException("Invalid direction {$direction}: Please specify N, S, E, or W.");
        }

        // Check if the starting position is clear (not occupied by an obstacle)
        if (!$planet->isClear($x, $y))
        {
            throw new InvalidStartingPositionException($x, $y);
        }

        $this->direction = $direction;
    }

    /**
     * Executes a series of movement commands for the rover.
     * 
     * @param string $commands
     * 
     * @throws \InvalidArgumentException
     */
    public function move(string $commands): void
    {
        $validMoves = ['F', 'L', 'R'];

        foreach (str_split(strtoupper($commands)) as $command)
        {
            if (!in_array($command, $validMoves)) {
                throw new \InvalidArgumentException("Invalid movement command {$command}: Use F, L, or R.");
            }

            switch ($command)
            {
                case "F":
                    $this->moveForward();
                    break;
                case "L":
                    $this->turn(-1);
                    break;
                case "R":
                    $this->turn(1);
                    break;
            }
        }
    }

    /**
     * Moves the rover one step forward in its current direction.
     * 
     * @throws OutOfBoundsException
     * @throws ObstacleEncounteredException
     */
    private function moveForward(): void
    {
        $tmpX = $this->x;
        $tmpY = $this->y;

        switch ($this->direction)
        {
            case "N":
                $tmpY++;
                break;
            case "S":
                $tmpY--;
                break;
            case "E":
                $tmpX++;
                break;
            case "W":
                $tmpX--;
                break;
        }

        // Check if the new position is outside the planet's bounds
        if ($tmpX < 0 || $tmpX >= $this->planet->size || $tmpY < 0 || $tmpY >= $this->planet->size)
        {
            throw new OutOfBoundsException($tmpX, $tmpY, $this->x, $this->y);
        }

        // Check if the new position is clear (not occupied by an obstacle)
        if ($this->planet->isClear($tmpX, $tmpY))
        {
            $this->x = $tmpX;
            $this->y = $tmpY;
        } else {
            throw new ObstacleEncounteredException($tmpX, $tmpY, $this->x, $this->y);
        }
    }

    /**
     * Turns the rover left or right.
     * 
     * @param int $rotation The direction of rotation: -1 for left, 1 for right.
     */
    private function turn(int $rotation): void
    {
        $clockwiseDirections = ['N', 'E', 'S', 'W'];
        $currentDirectionIndex = array_search($this->direction, $clockwiseDirections);

        $this->direction = $clockwiseDirections[($currentDirectionIndex + $rotation + 4) % 4];
    }
}