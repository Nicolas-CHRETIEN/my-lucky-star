
// Create a shadow for planets in the shape of a triangle.
function addShadow (width, reduceShadow) {

    // Add a gradiant to the shadow to make it follow the planet curve.
    let radial = context.createRadialGradient(-canvas.width / (width * 2), 0, canvas.width / ((width * 1.7) + reduceShadow), 0, 0, canvas.width / (width / 2));
    radial.addColorStop(0,"rgba(0, 0, 0, 0)");
    radial.addColorStop(0.1, "rgba(0, 0, 0, 0.6)");

    context.beginPath();
    context.fillStyle = radial;
    context.strokeStyle = radial;
    context.moveTo(0, -canvas.width / (width * 2) + reduceShadow); // Draw to the middle (0 is the center) left of the planet...
    context.lineTo(0, canvas.width / (width * 2) - reduceShadow); // Until the middle right...
    context.lineTo(canvas.width / (width / 2), 0); // And then reach a point two times further the planet width to hide the moons in the shadow.
    context.fill(); // Fill the triangle shape.
}