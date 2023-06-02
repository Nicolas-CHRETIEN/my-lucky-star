
// Create a new planet with an image.
function addPlanet(speedIndicator, distanceFromSun, width, imgName, spinIndicator, shadow) { // Shadow is used for Saturn which is specific because the image also contain the planet's rings. They do not produce a shadow. Venus's shadow is so smaller than the img width. Shadow is used to reduce the size of the shadow.
    context.save(); // Save to be able to restore here if a moon need to be added.
    context.translate(canvas.width / 2, canvas.height / 2); // Start at the center of the screen.
    let time = new Date(); // Define new time.

    // Below, 2 * PI transform a degre in radian. Depends on the speed indicator I select the spin'speed is gonna be hight or low.
    context.rotate(((2 * Math.PI) / (speedIndicator / 7)) * time.getDay() + ((2 * Math.PI) / (speedIndicator / 24)) * time.getHours() + ((2 * Math.PI) / (speedIndicator / 60)) * time.getMinutes() + ((2 * Math.PI) / speedIndicator) * time.getSeconds() + ((2 * Math.PI) / (speedIndicator * 1000)) * time.getMilliseconds() ); // SpeedIndicator is used to adapt speed of the objects based on earth speed. Earth takes 60 seconds to turn around the sun. For exemple if an object is two times slower than earth, its speedIndicator is gonna be 30.

    context.translate((canvas.width / distanceFromSun), 0); // Moove Earth to the corresponding distance from the center.

    addShadow(width, shadow); // Function used to add a triangle shadow shape to the planets.

    context.save();
    drawSpinningImage(imgName, width, time, spinIndicator);
    context.restore(); // Save and restore before adding the spinning image so that the moons don't be impacted by the spin.
}