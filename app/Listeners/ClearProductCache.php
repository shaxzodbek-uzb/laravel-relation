<?php

namespace App\Listeners;

use App\CacheManager\ProductStatistics;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearProductCache implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // sleep(10);
        throw new \Exception("Error Processing Request", 1);
        
        info('clear product cache listener triggered');
        ProductStatistics::clear();
    }
}
