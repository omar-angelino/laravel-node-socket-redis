<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserMessageEvent implements ShouldBroadcast
{
    // use Dispatchable, InteractsWithSockets, SerializesModels;
    use InteractsWithSockets, SerializesModels;
    
    public $from;
    public $to;
    public $message;
    
    public function __construct()
    {
        $this->from = 'Bond';
        $this->to = 'Bean';
        $this->message = 'You don\'t say??';
    }
    
    public function broadcastOn()  // the channel the message will send 
    {

        // return ['private-user-channel-1', '1'];
        return ['private-user-channel-1'];
    }
    
    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    // public function broadcastAs() // name of the event that will be listing in redis  normally it will use the class name
    // {
    //     return 'message';
    // }

    // public function broadcastWith() // if you  want to send more data to the broadcast, i will send all public variables that are inthis class event
    // {
    //     return ['id' => $this->user->id];
    // }
}
