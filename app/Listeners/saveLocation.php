<?php

namespace App\Listeners;

use App\Events\TrackingDelivery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Providers\EventServiceProvider;
use App\Models\Tracking;

class saveLocation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(TrackingDelivery $event): void
    {
        
    }
}
