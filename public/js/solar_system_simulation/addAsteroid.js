
// Declare the objects with arrays to contain asteroids particularities.
let randomAsteroids1 = {
    randomSpeed: [],
    randomSize: [],
    randomDistance: []
};
let randomAsteroids2 = {
    randomSpeed: [],
    randomSize: [],
    randomDistance: []
};
let randomAsteroids3 = {
    randomSpeed: [],
    randomSize: [],
    randomDistance: []
};

// To create an asteroids belt I need to draw a lot of asteroids with differents speed size and distance from the sun.
// This function generate random speed size and distances depending on the arguments.
    // Array is the name of the object containing arrays with random values.
    // Number is the number of asteroids we want to create.
    // minSpeed is the minimal value for speed the asteroids can have.
    // minSize is the minimal value for size the asteroids can have.
    // minDistance is the minimal value for distance from the center the asteroids can have.
    // The three next values are the differences for each specificities between the minimum and the maximum value that gonna be add to the min value.
function addAsteroidsBelt (array, number, minSpeed, minSize, minDistance, speedDifference, sizeDifference, distanceDifference) {
    for (index = 0; index < number; index++) {
        array.randomSpeed[index] = minSpeed + (Math.random() * speedDifference);
        array.randomSize[index] = minSize + (Math.random() * sizeDifference);
        array.randomDistance[index] = minDistance + (Math.random() * distanceDifference);
    }
}


// This function is the same than the one to add a planet, exept this one draw a shape insted of adding an img.
function addAsteroid (speedIndicator, distanceFromSun, size, color) {

    // Place the object and define the moovement.
    context.save();
    context.translate(canvas.width / 2, canvas.height / 2);
    let time = new Date();

    // Below, 2 * PI transform a degre in radian. Depends on the speed indicator I select the spin'speed is gonna be hight or low.
    context.rotate(((2 * Math.PI) / (speedIndicator / 7)) * time.getDay() + ((2 * Math.PI) / (speedIndicator / 24)) * time.getHours() + ((2 * Math.PI) / (speedIndicator / 60)) * time.getMinutes() + ((2 * Math.PI) / speedIndicator) * time.getSeconds() + ((2 * Math.PI) / (speedIndicator * 1000)) * time.getMilliseconds());
    context.translate((canvas.width / distanceFromSun), 0); // Distance always depends to the screen size.

    // Draw the shape.
    context.beginPath();
    context.arc(0, 0, (canvas.width / size), 0, Math.PI * 2, false);
    context.fillStyle = color;
    context.strokeStyle = color; 
    context.fill();
    context.stroke();

    // Restore to precedent save.
    context.restore();
    context.restore();
}