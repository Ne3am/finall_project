<?php

namespace App\Events;
use App\Listeners\saveLocation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Tracking;

class TrackingDelivery
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $lat  ;
    public $long;
    public $delivery_id;
    
    /**
     * Create a new event instance.
     */
    public function __construct( $delivery_id , $lat, $long)
    {
        $this->lat = $lat ;
        $this->long = $long;
        $this->delivery_id = $delivery_id;

        $D = Tracking::all()->where('delivery_id',$delivery_id);
        if( $D == '[]'){
            $track = new Tracking();
        $track->delivery_id = $delivery_id;
        $track->longTrack = $long;
        $track->latTrack =  $lat;
        $track->save();
        }else{
            Tracking::where('delivery_id', $delivery_id)->delete();
            $track = new Tracking();
        $track->delivery_id = $delivery_id;
        $track->longTrack = $long;
        $track->latTrack =  $lat;
        $track->save();
        }
        }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
