
function drawSpinningImage (imgName, width, time, spinIndicator) {

    // Below, 2 * PI transform a degre in radian. Depends on the speed indicator I select the spin'speed is gonna be hight or low.
    context.rotate(((2 * Math.PI) / (spinIndicator / 7)) * time.getDay() + ((2 * Math.PI) / (spinIndicator / 24)) * time.getHours() + ((2 * Math.PI) / (spinIndicator / 60)) * time.getMinutes() + ((2 * Math.PI) / spinIndicator) * time.getSeconds() + ((2 * Math.PI) / (spinIndicator * 1000)) * time.getMilliseconds()); 

    context.drawImage(imgName, - canvas.width / (width * 2), - canvas.width / (width * 2), canvas.width / width, canvas.width / width); // The image needs to be generate half its side before its center, so that the point indicated to rotate around the sun is the center of the image. By default it's the top left corner, so I soustract half of the image size for height and width. Next two arguments are the size of the image.
}