<!DOCTYPE html>
<html lang="en-US" ng-app="employeeRecords">
    <head>
        <title>Socket.IO chat De Laravel</title>
        <style>
          * { margin: 0; padding: 0; box-sizing: border-box; }
          body { font: 13px Helvetica, Arial; }
          form { background: #000; padding: 3px; position: fixed; bottom: 0; width: 100%; }
          form input { border: 0; padding: 10px; width: 90%; margin-right: .5%; }
          form button { width: 9%; background: rgb(130, 224, 255); border: none; padding: 10px; }
          #messages { list-style-type: none; margin: 0; padding: 0; }
          #messages li { padding: 5px 10px; }
          #messages li:nth-child(odd) { background: #eee; }
        </style>
    </head>
    <body>
        <h2>Chat</h2>
        <button id="Send">Server</button>
        <button id="Logout">Logout</button>
        <ul id="messages"></ul>
        <form id="form" action="">
          <input id="m" autocomplete="off" /><button>Send</button>
        </form>
       <script src="http://localhost:8080/socket.io/socket.io.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      
        <script>
          $(function () 
          {

            var socket = io('http://localhost:8080',{ query : "userId="+ {{ $id }} });

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
          });

        </script>    
    </body>
</html>