<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use MarsRover\Planet;

final class PlanetTest extends TestCase
{
    public function testGeneratesObstacles(): void
    {
        $size = 100;
        $planet = new Planet($size);
        $amountObstacles = count($planet->getObstacles());

        $this->assertEquals(($size * 0.1), $amountObstacles);
    }

    public function testIsClear(): void
    {
        $planet = new Planet(100);
        $obstacles = $planet->getObstacles();

        $this->assertNotEmpty($obstacles);
        $this->assertFalse($planet->isClear($obstacles[0]->x, $obstacles[0]->y));

        do {
            $x = rand(0, $planet->size - 1);
            $y = rand(0, $planet->size - 1);
            if ($planet->isClear($x, $y)) {
                $clearX = $x;
                $clearY = $y;
            }
        } while ($clearX === null && $clearY === null);
        $this->assertTrue($planet->isClear($clearX, $clearY));
    }

    // Exception tests

    public function testGeneratePlanetWithIncorrectSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Planet(0);

        $this->expectException(InvalidArgumentException::class);
        new Planet(-10);
    }
}
