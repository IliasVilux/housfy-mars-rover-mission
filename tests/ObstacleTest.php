<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use MarsRover\Obstacle;

final class ObstacleTest extends TestCase
{
    public function testIsOccupiedByObstacle(): void
    {
        $obstacle = new Obstacle(0, 0);
        $this->assertTrue($obstacle->isOccupied(0, 0));
        $this->assertFalse($obstacle->isOccupied(1, 0));
        $this->assertFalse($obstacle->isOccupied(0, 1));
        $this->assertFalse($obstacle->isOccupied(1, 1));
    }
}
