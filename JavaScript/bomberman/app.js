const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const localtunnel = require('localtunnel');
const httpPort = 2000;

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/client/index.html');
});
app.use('/client', express.static(__dirname + '/client'));
// Start express server on port (const): httpPort
http.listen(httpPort, () => console.log(`Server started at port: ${httpPort}`));

var SOCKET_LIST = {};
var PLAYER_LIST = {};
const grid = 64;
const numRows = 13;
const numCols = 15;

const template = [
    ['▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉'],
    ['▉', 'x', 'x', , , , , , , , , , 'x', 'x', '▉'],
    ['▉', 'x', '▉', , '▉', , '▉', , '▉', , '▉', , '▉', 'x', '▉'],
    ['▉', 'x', , , , , , , , , , , , 'x', '▉'],
    ['▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉'],
    ['▉', , , , , , , , , , , , , , '▉'],
    ['▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉'],
    ['▉', , , , , , , , , , , , , , '▉'],
    ['▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉', , '▉'],
    ['▉', 'x', , , , , , , , , , , , 'x', '▉'],
    ['▉', 'x', '▉', , '▉', , '▉', , '▉', , '▉', , '▉', 'x', '▉'],
    ['▉', 'x', 'x', , , , , , , , , , 'x', 'x', '▉'],
    ['▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉', '▉']
];

var Player = function(id) {
    var self = {
        row:1,
        col:1,
        radius: grid * 0.35,
        bombAmount:1,
        bombSize: 2,
        id:id
    };
    return self;
};

io.on('connection', (socket) => {
    socket.id = Math.floor(9999999999 * Math.random());
    SOCKET_LIST[socket.id] = socket;

    var player = Player(socket.id);
    PLAYER_LIST[socket.id] = player;

    console.log(`User CONNECTED: id ${socket.id}`);
    socket.on('disconnect', () => {
        delete SOCKET_LIST[socket.id];
        delete PLAYER_LIST[socket.id];
        console.log(`User DISCONNECTED: id ${socket.id}`);
    });

    socket.on('keyPress', (data) => {
        velocityHandler(data)
        function velocityHandler(data) {
            switch (data.inputId) {
                case 'w':
                case 'ArrowUp':
                    player.col--
                    break;
                case 'a':
                case 'ArrowLeft':
                    player.row--
                    break;
                case 's':
                case 'ArrowDown':
                    player.col++
                    break;
                case 'd':
                case 'ArrowRight':
                    player.row++
                    break;
            };
        };
    });
    socket.on('chatMessage', (msg) => {
        socket.broadcast.emit('chatMessage', msg);
    });
    io.sockets.on('connection', function (socket) {
      socket.on('peng', function() {
        socket.emit('latency');
      });
    });
});

setInterval(function() {
    var packet = [];
    for (var i in PLAYER_LIST) {
        var player = PLAYER_LIST[i];
        //player.updatePosition();
        packet.push({
            col:player.col,
            row:player.row,
            rad:player.radius,
            id:player.id
        })
    }
    for (var i in SOCKET_LIST) {
        var socket = SOCKET_LIST[i];
        socket.emit('newPositions', packet);
    }
},1000/25);

// Load localtunnel
(async () => {
    const tunnel = await localtunnel({
        port: httpPort,
        subdomain: 'mico'
    });
    // the assigned public url for your tunnel
    console.log(tunnel.url);
    // tunnels are closed
    tunnel.on('close', () => {});
})();
