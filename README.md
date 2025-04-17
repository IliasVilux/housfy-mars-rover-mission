<div align="center">

# 🚀 Mars Rover Mission

</div>

This project is a technical exercise to develop a small PHP application simulating the movement of a Mars rover on a square-shaped planet.

The application must meet the following requirements:

- You are given the initial starting point (`x`,`y`) of a rover and the direction (`N`,`S`,`E`,`W`)
it is facing.
- The rover receives a collection of commands. (E.g.) `FFRRFFFRL`.
- The rover can move forward (`f`).
- The rover can move left/right (`l`,`r`).
- Suppose we are on a really weird planet that is square. `200x200` for example :)
- Implement obstacle detection before each move to a new square. If a given
sequence of commands encounters an obstacle, the rover moves up to the last
possible point, aborts the sequence and reports the obstacle.


## 📑 Table of Contents
- [🚀 Mars Rover Mission](#-mars-rover-mission)
  - [📑 Table of Contents](#-table-of-contents)
  - [📁 Project Structure](#-project-structure)
  - [⚙️ Requirements](#️-requirements)
  - [📦 Installation](#-installation)
  - [▶️ Running the Project](#️-running-the-project)
  - [🔍 Class Descriptions](#-class-descriptions)
    - [`Rover`](#rover)
    - [`Planet`](#planet)
    - [`Obstacle`](#obstacle)
  - [⚠️ Custom Exceptions](#️-custom-exceptions)
    - [`InvalidStartingPositionException`](#invalidstartingpositionexception)
    - [`ObstacleEncounteredException`](#obstacleencounteredexception)
    - [`OutOfBoundsException`](#outofboundsexception)
  - [📌 Key Note](#-key-note)
  - [✅ Tests](#-tests)
    - [📌 How to run tests](#-how-to-run-tests)
    - [🔍 Covered scenarios](#-covered-scenarios)
      - [🌠 Obstacle Behavior](#-obstacle-behavior)
      - [🪐 Planet Behavior](#-planet-behavior)
      - [🚗 Rover Behavior](#-rover-behavior)
  - [📚 Technologies Used](#-technologies-used)

---

## 📁 Project Structure

```txt
mars-rover/
│
├── src/
│   └── Exceptions/
│       ├── InvalidStartingPositionException.php
│       ├── ObstacleEncounteredException.php
│       └── OutOfBoundsException.php
│   ├── Obstacle.php
│   ├── Planet.php
│   └── Rover.php
│
├── tests/
│   ├── ObstacleTest.php
│   ├── PlanetTest.php
│   └── RoverTest.php
│
├── index.php
├── composer.json
├── composer.lock
├── phpunit.xml
└── README.md
```

---

## ⚙️ Requirements

- PHP 8.0 or higher
- Composer

---

## 📦 Installation

```bash
git clone https://github.com/IliasVilux/housfy-mars-rover-mission.git
cd housfy-mars-rover-mission
composer install
```

---

## ▶️ Running the Project

```bash
php index.php
```

This will deploy a rover on the planet and execute a sequence of movement commands. Results will be displayed in the console.

> ℹ️ **Note:** In `index.php`:
> - The planet is initialized with a size parameter (default: 200).
> - The Rover is created with initial coordinates `(x, y)`, a facing direction, and a reference to the planet. Defaults: `(45, 115, "N")`. The planet must always be passed explicitly.

---

## 🔍 Class Descriptions

### `Rover`
- Creates the rover with a position, direction, and a planet reference.
- Validates position, direction, and ensures the starting point is not occupied or out of bounds.
- `move(string $commands)`: Executes a string of movement commands (`F`, `L`, `R`), checking each for validity.
- `moveForward()`: Moves the rover forward if the destination is within bounds and obstacle-free.
- `turn(int $rotation)`: Rotates the rover left (`-1`) or right (`1`), updating its facing direction accordingly.

### `Planet`
- Represents the square-shaped planet with a customizable size (`default: 200x200`).
- Automatically generates obstacles on creation.
- `generateObstacles()`: Randomly places obstacles, covering 10% of the planet area.
- `isClear(int $x, int $y)`: Checks if a coordinate is free of obstacles.

### `Obstacle`
- Represents an obstacle at specific `(x, y)` coordinates.
- `isOccupied(int $x, int $y)`: Checks if a given coordinate is occupied by this obstacle.

---

## ⚠️ Custom Exceptions

### `InvalidStartingPositionException`
- Thrown when the rover's starting position is out of bounds or occupied by an obstacle.

### `ObstacleEncounteredException`
- Thrown when the rover encounters an obstacle during movement.

### `OutOfBoundsException`
- Thrown when the rover attempts to move outside the planet's limits.

---

## 📌 Key Note

- Command execution stops immediately if an obstacle or boundary is detected.

---

## ✅ Tests

Unit tests are written using [PHPUnit](https://phpunit.de/). They cover the core logic of the Mars Rover Mission application, including obstacle detection, movement behavior, and input validation.

### 📌 How to run tests

To run the tests, ensure you're in the project root directory and then execute:

```bash
./vendor/bin/phpunit
```

### 🔍 Covered scenarios

The following areas of the application are tested:

#### 🌠 Obstacle Behavior

- `testIsOccupiedByObstacle`: Checks that an `Obstacle` correctly reports if a position is occupied.

#### 🪐 Planet Behavior

- `testGeneratesObstacles`: Verifies that a new planet generates 10% of its area as obstacles.

- `testIsClear`: Confirms that the `isClear()` method correctly identifies whether a coordinate is free or occupied by an obstacle.

- `testGeneratePlanetWithIncorrectSize` *(exception test)*: Ensures an `InvalidArgumentException` is thrown if the planet size is zero or negative.

#### 🚗 Rover Behavior

- `testMoveForwardInEachDirection`: Validates that the rover moves forward correctly in all cardinal directions (`N`,`S`,`E`,`W`).

- `testTurnLeft` / `testTurnRight`: Ensures the rover updates its direction accurately when turning left or right.

- `testMoveCollectionCommands`: Executes a full command sequence (`FFRLF...`) and confirms the rover ends in the expected position.

- `testCreateRoverOutsideBounds` *(exception test)*: Throws `OutOfBoundsException` if the rover is initialized outside the planet boundaries.

- `testCreateRoverWithInvalidDirection` *(exception test)*: Throws `InvalidArgumentException` for invalid direction inputs.

- `testCreateRoverWithObstacleAtStart` *(exception test)*: Throws `InvalidStartingPositionException` if the initial position is blocked by an obstacle.

- `testMoveWithInvalidCommand` *(exception test)*: Throws `InvalidArgumentException` when the rover receives an unsupported command.

- `testMoveOutOfBounds` *(exception test)*: Throws `OutOfBoundsException` if a movement would take the rover beyond the limits of the planet.

- `testMoveIntoObstacle` *(exception test)*: Throws `ObstacleEncounteredException` if the rover will collide with an obstacle.

---

## 📚 Technologies Used

- PHP 8
- Composer (autoloading)
- PSR-4 Autoloading Standard
- Custom Exceptions
- OOP principles
- PHPUnit (for unit testing)

---