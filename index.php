<?php

require __DIR__ . '/vendor/autoload.php';

use MarsRover\Planet;
use MarsRover\Rover;

try {
    $planet = new Planet(50);
    $rover = new Rover(13, 26, "N", $planet);
    
    echo "🚀 Rover successfully deployed at initial position ({$rover->x}, {$rover->y}), facing {$rover->direction}.";

    $rover->move("FFRRFFFRL");

    echo "✅ Mission update: Movement completed. New position: ({$rover->x}, {$rover->y}), facing {$rover->direction}.";
} catch (InvalidStartingPositionException $e) {
    echo "❌ Landing error: " . $e->getMessage();

} catch (OutOfBoundsException $e) {
    echo "❌ Movement canceled: " . $e->getMessage();

} catch (ObstacleEncounteredException $e) {
    echo "⚠️ Obstacle encountered: " . $e->getMessage();

} catch (\InvalidArgumentException $e) {
    echo "❗ Invalid input: " . $e->getMessage();

} catch (\Exception $e) {
    echo "🚨 Unexpected error: " . $e->getMessage();
}