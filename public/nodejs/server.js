var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var usersSocket ={}; // user sockets
var usersId={}; // user sockets
const port = 8080;
const hostName = '127.0.0.1';
const redis =   require('redis');
var redisClient = redis.createClient();

redisClient.on('error', function (error) {
    console.log('Redis: ERROR ' + error)
})

redisClient.on('subscribe', function (channel, count) {
    console.log('Redis: Subscribe To Channel:', channel, count)
})

redisClient.on('unsubscribe', function (channel, count) 
{
    console.log('Redis: Unsubscribe To Channel:', channel, count)
})

// Handle messages from laravel to a channels we're subscribed to
redisClient.on('message', function (channel, payload) 
{
  console.log(' Redis: INCOMING MESSAGE', "channel", channel , "data", payload)
  payload = JSON.parse(payload)
  // Send the data through to any client in the channel room (!)
  var event = payload.event;
  io.in(channel).emit(event, payload)
  console.log('Node: MESSAGE SEND')
})

io.on('connection', function(socket, next)
{
  console.log('Node:User Connected to Server');
  var userId = socket.handshake.query.userId;
  console.log("With ID:", userId);
  var PRIVATE_CHANNEL = "we-private-user-channel-"+userId;
  usersSocket[socket] =  userId;
  usersId[userId] = socket;
  console.log('Node: Subscribing TO CHANNEL in Redis :', PRIVATE_CHANNEL );
  redisClient.subscribe(PRIVATE_CHANNEL)
  socket.join(PRIVATE_CHANNEL)
  socket.on('subscribe-to-channel', function (data) {
  console.log('SUBSCRIBE TO CHANNEL', data);
  // Subscribe to the Redis channel using our global subscriber
  redisClient.subscribe(data.channel)
  // Join the (somewhat local) server room for this channel. This
  // way we can later pass our channel events right through to 
  // the room instead of broadcasting them to every client.
    socket.join(data.channel)
  })
  socket.on('disconnect', function()
  {
    console.log('user disconnected');
    redisClient.unsubscribe("we-private-user-channel-"+usersSocket[socket]);
  });
  
  socket.on('chat', function(userId,message)
  {
    console.log('Userid:' + userId + 'message: ' + message);
    console.log('Socket :' + usersId[userId] );
    socket.to(usersId[userId].id).emit('chat', message);
  });

  socket.on('postServer', function(event,data)//using http that comes with Node
  {
    console.log('Sending information to Server');
    var httpRequest = require('http');
    httpRequest.get('http://chat.dev/nodetest', (resp) => {
      let data = '';
      // A chunk of data has been recieved.
      resp.on('data', (chunk) => {
        data += chunk;
      });
      // The whole response has been received. Print out the result.
      resp.on('end', () => {
        // console.log(JSON.parse(data).explanation);
        console.log("Message From request :"+data);
        socket.emit('getServer', data);
      });
     
    }).on("error", (err) => {
      console.log("Error: " + err.message);
    });
  });
});

http.listen(port,hostName, function(){
  console.log('listening on '+  hostName +':'+ port);
});