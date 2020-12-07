// DISCLAIMER: Shitty rushed code that was made with little to no effort in to optimizing or making it readable by a sane person
// featuring if monsters and multiple functions with almost the same functionality

const ctx = document.getElementById('canvas').getContext('2d');
var canvas = document.getElementById('canvas');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
var PARTICLE_LIST = [];

function init() {
    window.requestAnimationFrame(draw);
}

var Particle = function(x, y, speedX, speedY, size, opacity) {
    return {
        x: x,
        y: y,
        speedX: speedX,
        speedY: speedY,
        size: size,
        opacity: opacity
    };
};

function particleGenerator() {
    var particleStartX = Math.floor(canvas.width * Math.random());
    var particleStartY = Math.floor(canvas.height * Math.random());
    var particleStartSpeedX = Math.floor(11 * Math.random()) - 5;
    while (particleStartSpeedX == 0) particleStartSpeedX = Math.floor(11 * Math.random()) - 5;
    var particleStartSpeedY = Math.floor(11 * Math.random()) - 5;
    while (particleStartSpeedY == 0) particleStartSpeedY = Math.floor(11 * Math.random()) - 5;
    var particleStartSize = Math.floor(10 * Math.random()) + 5;
    var particleStartOpacity = 0.75 * Math.random() + 0.25;
    var particle = Particle(particleStartX, particleStartY, particleStartSpeedX, particleStartSpeedY, particleStartSize, particleStartOpacity);
    PARTICLE_LIST.push(particle);
}

// Amount of particles to initially spawn
var particleMax = 100;
while (particleMax > PARTICLE_LIST.length) {
    particleGenerator();
}

// Spawn more particles off screen when older ones disappear
function particleSpawn(i) {
    // IDEA: Could use .splice but this causes weird flickering with the particles
    if (i) delete PARTICLE_LIST[i];

    var particleStartX = Math.floor(canvas.width * Math.random());
    var particleStartY = Math.floor(canvas.height * Math.random());
    var particleDirection = Math.floor(4 * Math.random());
    // Adove
    if (particleDirection == 0 ) {
        particleStartY = -50;
        var particleStartSpeedY = Math.floor(5 * Math.random()) + 1;
        var particleStartSpeedX = Math.floor(11 * Math.random()) - 5;
    }
    // Left
    if (particleDirection == 1 ) {
        particleStartX = -50;
        var particleStartSpeedX = Math.floor(5 * Math.random()) + 1;
        var particleStartSpeedY = Math.floor(11 * Math.random()) - 5;
    }
    // Below
    if (particleDirection == 2 ) {
        particleStartY = canvas.height + 50;
        var particleStartSpeedY = Math.floor(5 * Math.random()) - 5;
        var particleStartSpeedX = Math.floor(11 * Math.random()) - 5;
    }
    // Right
    if (particleDirection == 3 ) {
        particleStartX = canvas.width + 50;
        var particleStartSpeedX = Math.floor(5 * Math.random()) - 5;
        var particleStartSpeedY = Math.floor(11 * Math.random()) - 5;
    }
    var particleStartSize = Math.floor(10 * Math.random()) + 5;
    var particleStartOpacity = 0.75 * Math.random() + 0.25;
    console.log(particleStartX, particleStartY, particleStartSpeedX, particleStartSpeedY);
    var particle = Particle(particleStartX, particleStartY, particleStartSpeedX, particleStartSpeedY, particleStartSize, particleStartOpacity);
    PARTICLE_LIST.push(particle);
    console.log('Added particle at ' + particle.x + ' ' + particle.y);
}

var frameCounter=0;
function draw() {
    if(++frameCounter % 4){
        window.requestAnimationFrame(draw);
        return false;
    }
    ctx.globalCompositeOperation = 'copy';
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.canvas.width = window.innerWidth;
    ctx.canvas.height = window.innerHeight;

    var canvasGradient = ctx.createLinearGradient(0, canvas.height, canvas.width, 0);
    canvasGradient.addColorStop(0, "#19acff");
    canvasGradient.addColorStop(.7, "#b743ff");
    ctx.fillStyle = canvasGradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Update particles
    for (var i in PARTICLE_LIST) {
        var particle = PARTICLE_LIST[i]
        if (particle.x >= canvas.width + 100) particleSpawn(i);
        if (particle.x <= 0 - 100) particleSpawn(i);
        if (particle.y >= canvas.height + 100) particleSpawn(i);
        if (particle.y <= 0 - 100) particleSpawn(i);
        particle.x += particle.speedX;
        particle.y += particle.speedY;
        ctx.beginPath();
        ctx.globalAlpha = particle.opacity;
        ctx.arc(particle.x, particle.y, particle.size, 0, 2 * Math.PI);
        ctx.fillStyle = 'white';
        ctx.fill();
    }
    window.requestAnimationFrame(draw);
}

init();
