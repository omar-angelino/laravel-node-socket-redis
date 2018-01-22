 
  alert("E");
  var socket = io('http://localhost:8080',{ query : "userId="+ 1 });

  socket.on('event', function(data)
  {
    if(data.type == "message")
    {
      $('#messages').append($('<li>').text(1+data.message));
    }
  });

  socket.on('chat', function(data)
  {
    $('#messages').append($('<li>').text(data));
  });

  $( "#Logout" ).click(function( ) 
  {
    socket.disconnect();
  });

  $( "#form" ).submit(function( event ) 
  {
    event.preventDefault();
    socket.emit('chat', 1 ,$('#m').val());
    $('#m').val("");
  });
    
   $( "#Send" ).click(function( ) 
  {
     socket.emit('postServer', "eventExample" ,"Nothing");
  });

  socket.on('getServer', function(data)
  {
    $('#messages').append($('<li>').text(data));
  });

