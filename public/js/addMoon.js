
function addMoon (speedIndicator, distanceFromPlanet, width, imgName) {
    context.save();
    let time = new Date();

    // Below, 2 * PI transform a degre in radian. Depends on the speed indicator I select the spin'speed is gonna be hight or low.
    context.rotate(((2 * Math.PI) / (speedIndicator / 7)) * time.getDay() + ((2 * Math.PI) / (speedIndicator / 24)) * time.getHours() + ((2 * Math.PI) / (speedIndicator / 60)) * time.getMinutes() + ((2 * Math.PI) / speedIndicator) * time.getSeconds() + ((2 * Math.PI) / (speedIndicator * 1000)) * time.getMilliseconds() ); // SpeedIndicator is used to adapt speed of the objects based on earth speed.
    //  This way as Earth's speed indicator is 60, it takes 1 minute for one year simulated.
    //  Earth takes 60 seconds to turn around the sun. For exemple if an object is two times faster than earth, its speedIndicator is gonna be 30 (the faster it goes, the smaller its speed indicator is gonna be).

    context.translate(distanceFromPlanet, 0);
    context.drawImage(imgName, 0, 0, canvas.width / width, canvas.height / width); // The distances need to be function of the screen size.
}

// Make Uranus moons follow an elips instead of a circle.
function addUranusMoon (speedIndicator, distanceFromPlanet, width, imgName) {
    context.save();
    let time = new Date();

    let rotationValue = ((2 * Math.PI) / (speedIndicator / 7)) * time.getDay() + ((2 * Math.PI) / (speedIndicator / 24)) * time.getHours() + ((2 * Math.PI) / (speedIndicator / 60)) * time.getMinutes() + ((2 * Math.PI) / speedIndicator) * time.getSeconds() + ((2 * Math.PI) / (speedIndicator * 1000)) * time.getMilliseconds();

    // Below, 2 * PI transform a degre in radian. Depends on the speed indicator I select the spin'speed is gonna be hight or low.
    context.rotate(rotationValue); // SpeedIndicator is used to adapt speed of the objects based on earth speed. Earth takes 60 seconds to turn around the sun. For exemple if an object is two times slower than earth, its speedIndicator is gonna be 30.
    
    
    for (let index = 1; index < 60 / speedIndicator; index++) {
        if (time.getSeconds() + (time.getMilliseconds() / 1000) > speedIndicator * index & time.getSeconds() + (time.getMilliseconds() / 1000) <= speedIndicator * index + (speedIndicator / 4)) {

            let comptor = (time.getSeconds() + (time.getMilliseconds() / 1000) - (speedIndicator * (index))); // Compt the time of this quarter of turn.

            // We want here to add 1 for each second that las a quarter of the turn.
            // As speedIndicator is the number of seconds necessary to make 1 turn, withdraw the seconds we don't need for the operation.
            let correctedDistance = distanceFromPlanet + comptor * 30;

            context.translate(correctedDistance, 0);

        console.log("A");
        console.log("comptor: " + comptor);
        console.log("distance de Uranus: " + correctedDistance);


        } else if (time.getSeconds() + (time.getMilliseconds() / 1000) > speedIndicator * index & time.getSeconds() + (time.getMilliseconds() / 1000) <= speedIndicator * index + (speedIndicator / 4) * 2) {

            let comptor = 1 - ((time.getSeconds() + (time.getMilliseconds() / 1000)) - ((index) * speedIndicator) - (speedIndicator / 4)); // Compt the time of this quarter of turn.

            // The distance increased of speedIndicator seconds last quarter. So I add these seconds to the distance.
            // Then I withdraw the seconds for all the turns already made during the current minut + 1 quarter of turn.
            let correctedDistance = distanceFromPlanet + comptor * 30;

            context.translate(correctedDistance, 0);
            console.log("B");
            console.log("comptor: " + comptor);
            console.log("distance de Uranus: " + correctedDistance);


        } else if (time.getSeconds() + (time.getMilliseconds() / 1000) > speedIndicator * index & time.getSeconds() + (time.getMilliseconds() / 1000) <= speedIndicator * index + (speedIndicator / 4) * 3) {

            let comptor = (time.getSeconds() + (time.getMilliseconds() / 1000)) - ((index) * speedIndicator) - (speedIndicator / 4) * 2; // Compt the time of this quarter of turn.

            let correctedDistance = distanceFromPlanet + comptor * 30;

            context.translate(correctedDistance, 0);
            console.log("C");
            console.log("comptor: " + comptor);
            console.log("distance de Uranus: " + correctedDistance);


        } else if (time.getSeconds() + (time.getMilliseconds() / 1000) > speedIndicator * index + (speedIndicator / 4) * 3 & time.getSeconds() + (time.getMilliseconds() / 1000) < speedIndicator * (index + 1)) {
            
            let comptor = 1 - ((time.getSeconds() + (time.getMilliseconds() / 1000)) - ((index) * speedIndicator) - (speedIndicator / 4) * 3); // Compt the time of this quarter of turn.

            let correctedDistance = distanceFromPlanet + comptor * 30;

            context.translate(correctedDistance, 0);
            console.log("D");
            console.log("comptor: " + comptor * comptor);
            console.log("distance de Uranus: " + correctedDistance);

        }
    }

    // context.translate(distanceFromPlanet, 0);
    context.drawImage(imgName, 0, 0, canvas.width / width, canvas.height / width); // The distances need to be function of the screen size.
}