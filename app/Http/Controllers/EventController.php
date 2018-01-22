<?php
namespace App\Http\Controllers;

use App\Events\UserMessageEvent;
use Illuminate\Support\Facades\Redis;
 
class EventController extends Controller {
	
	public function index()
	{
		return view('home');
	}
	public function event()
	{
		// $userId = 1; // this is sending a message directo to redis
		// $channel = "private-user-channel-". $userId;
  //       $message = "Tiene una nueva notificacion";
  //       $event = "event";
  //       $type = "message";
  //       $redis = Redis::connection();
  //       $redis->publish($channel, json_encode(  ['message' => $message,'event' => $event,'type' => $type, '_channel' => $channel]));
  //       die("Mandamos la vaina");
        event (new UserMessageEvent()); // this event will send a broadcast to redis
	
	}
}