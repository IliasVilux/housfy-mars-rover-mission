# 🚀 Mars Rover Mission

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

---

## 📁 Project Structure

```txt
mars-rover/
│
├── src/
│   ├── Rover.php
│   ├── Planet.php
│   ├── Obstacle.php
│   └── Exceptions/
│       ├── InvalidStartingPositionException.php
│       ├── ObstacleEncounteredException.php
│       └── OutOfBoundsException.php
│
├── index.php
├── composer.json
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

## 🔍 Descripción de Clases

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

## 📚 Technologies Used

- PHP 8
- Composer (autoloading)
- PSR-4 Autoloading Standard
- Custom Exceptions
- OOP principles

---