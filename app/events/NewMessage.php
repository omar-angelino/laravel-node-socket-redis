<?php
namespace App\Events;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
class NewMessage extends Event implements ShouldBroadcast
{
    
    use SerializesModels;
    
    public $from;
    public $to;
    public $message;
    
    public function __construct()
    {
        $this->from = 'Bond';
        $this->to = 'Bean';
        $this->message = 'You don\'t say??';
    }
    
    public function broadcastOn()
    {
        
        return ['yourprivatehashedchannelid', 'thiscouldbeaglobalchanneltoo'];
    }
    
    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'messages.new';
    }
    
}