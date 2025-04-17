<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use MarsRover\Planet;
use MarsRover\Rover;

use MarsRover\Exceptions\InvalidStartingPositionException;
use MarsRover\Exceptions\OutOfBoundsException;
use MarsRover\Exceptions\ObstacleEncounteredException;

final class RoverTest extends TestCase
{
    public function testMoveForwardInEachDirection(): void
    {
        $planet = new Planet(100);

        // North
        $rover = new Rover(49, 49, 'N', $planet);
        $rover->move('F');
        $this->assertEquals([49, 50], [$rover->x, $rover->y]);

        // South
        $rover = new Rover(49, 49, 'S', $planet);
        $rover->move('F');
        $this->assertEquals([49, 48], [$rover->x, $rover->y]);

        // East
        $rover = new Rover(49, 49, 'E', $planet);
        $rover->move('F');
        $this->assertEquals([50, 49], [$rover->x, $rover->y]);

        // West
        $rover = new Rover(49, 49, 'W', $planet);
        $rover->move('F');
        $this->assertEquals([48, 49], [$rover->x, $rover->y]);
    }

    public function testTurnLeft(): void
    {
        $planet = new Planet(100);
        $rover = new Rover(49, 49, 'N', $planet);

        // N -> W
        $rover->move('l');
        $this->assertEquals('W', $rover->direction);

        // W -> S
        $rover->move('L');
        $this->assertEquals('S', $rover->direction);
        
        // S -> E
        $rover->move('l');
        $this->assertEquals('E', $rover->direction);
        
        // E -> N
        $rover->move('L');
        $this->assertEquals('N', $rover->direction);
        
        // N -> S
        $rover->move('Ll');
        $this->assertEquals('S', $rover->direction);
    }

    public function testTurnRight(): void
    {
        $planet = new Planet(100);
        $rover = new Rover(49, 49, 'N', $planet);

        // N -> E
        $rover->move('r');
        $this->assertEquals('E', $rover->direction);

        // E -> S
        $rover->move('R');
        $this->assertEquals('S', $rover->direction);
        
        // S -> W
        $rover->move('R');
        $this->assertEquals('W', $rover->direction);
        
        // W -> N
        $rover->move('r');
        $this->assertEquals('N', $rover->direction);
        
        // N -> S
        $rover->move('rR');
        $this->assertEquals('S', $rover->direction);
    }

    public function testMoveCollectionCommands(): void
    {
        $planet = new Planet(100);
        $rover = new Rover(49, 49, 'N', $planet);

        $rover->move('FFRRFFFRL');

        $this->assertEquals([49, 48, 'S'], [$rover->x, $rover->y, $rover->direction]);
    }

    // Exception tests

    public function testCreateRoverOutsideBounds(): void
    {
        $planet = new Planet(100);
        
        $this->expectException(InvalidStartingPositionException::class);
        $rover = new Rover(101, 49, 'N', $planet);
    }

    public function testCreateRoverWithInvalidDirection(): void
    {
        $planet = new Planet(100);
        
        $this->expectException(InvalidArgumentException::class);
        $rover = new Rover(4, 49, 'X', $planet);
    }

    public function testCreateRoverWithObstacleAtStart(): void
    {
        $planet = new Planet(100);
        $planet->addObstacle(1, 1);
        
        $this->expectException(InvalidStartingPositionException::class);
        $rover = new Rover(1, 1, 'N', $planet);
    }

    public function testMoveWithInvalidCommand(): void
    {
        $planet = new Planet(100);
        $rover = new Rover(1, 1, 'N', $planet);
        
        $this->expectException(InvalidArgumentException::class);
        $rover->move("X");
    }

    public function testMoveOutOfBounds(): void
    {
        $planet = new Planet(100);
        $rover = new Rover(99, 99, 'N', $planet);
        
        // Out of bounds in north
        $this->expectException(OutOfBoundsException::class);
        $rover->move('F');

        // Out of bounds in east
        $rover->move('R');
        $this->expectException(OutOfBoundsException::class);
        $rover->move('F');

        $rover = new Rover(0, 0, 'S', $planet);

        // Out of bounds in south
        $this->expectException(OutOfBoundsException::class);
        $rover->move('F');

        // Out of bounds in west
        $rover->move('R');
        $this->expectException(OutOfBoundsException::class);
        $rover->move('F');
    }

    public function testMoveIntoObstacle(): void
    {
        $planet = new Planet(100);
        $planet->addObstacle(0, 1);
        $rover = new Rover(0, 0, 'N', $planet);

        $this->expectException(ObstacleEncounteredException::class);
        $rover->move('F');
    }
}

