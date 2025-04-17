<?php

namespace MarsRover;

use MarsRover\Exceptions\OutOfBoundsException;
use MarsRover\Exceptions\ObstacleEncounteredException;

class Rover
{
    public function __construct(public int $x = 0, public int $y = 0, public string $direction = "N",private Planet $planet)
    {
        $this->direction = strtoupper($direction);
        $validDirections = ['N', 'S', 'E', 'W'];

        if (!in_array($this->direction, $validDirections)) {
            throw new \InvalidArgumentException("La dirección {$this->direction} es inválida. (N, S, E o W)");
        }
    }

    public function move(string $commands): void
    {
        $validMoves = ['F', 'L', 'R'];

        foreach (str_split(strtoupper($commands)) as $command)
        {
            if (!in_array($command, $validMoves)) {
                throw new \InvalidArgumentException("El movimiento {$this->command} es inválido. (F, L ,R)");
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

        if ($tmpX < 0 || $tmpX >= $this->planet->size || $tmpY < 0 || $tmpY >= $this->planet->size)
        {
            throw new OutOfBoundsException($tmpX, $tmpY, $this->x, $this->y);
        }

        if ($this->planet->isClear($tmpX, $tmpY))
        {
            $this->x = $tmpX;
            $this->y = $tmpY;
        } else {
            throw new ObstacleEncounteredException($tmpX, $tmpY, $this->x, $this->y);
        }
    }

    private function turn(int $rotation): void
    {
        $clockwiseDirections = ['N', 'E', 'S', 'W'];
        $currentDirectionIndex = array_search($this->direction, $clockwiseDirections);

        $this->direction = $clockwiseDirections[($currentDirectionIndex + $rotation + 4) % 4];
    }
}