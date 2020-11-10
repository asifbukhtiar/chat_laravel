var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var redis = require('redis');
//var redis = new Redis();


http.listen(6999, function(){
    console.log('Port 6999 Connected');
});

io.on('connection', function(socket){

    var redisClient = redis.createClient();

    redisClient.subscribe('message');
    redisClient.subscribe('privatechat');

    redisClient.on('message', function(channel, message){
        if(channel == 'message')
        {
            console.log('Redis: Message on ' + channel + ' received!');
            socket.emit(channel, message);
        }else if(channel == 'privatechat'){
            console.log('Redis: Chat on ' + channel + ' delivered!');
            socket.emit(channel, message);
        }

    });

    socket.on('disconnect', function(){
        redisClient.quit();
    });
});

process.setMaxListeners(0);


