
// Draw a filled arc.
// Thi is used to create a planete shape, for ... a planet a moon or an asteroid.
function drawFilledArc (x, y, size, color) { //Possibility to chose place, size and the color.
    context.beginPath();
    context.arc(x, y, (canvas.width / size), 0, Math.PI * 2, false);
    context.fillStyle = color;
    context.strokeStyle = color;
    context.fill();
    context.stroke();
}