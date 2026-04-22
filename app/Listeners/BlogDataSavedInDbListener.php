<?php

namespace App\Listeners;

use App\Events\BlogDataSavedInDbEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class BlogDataSavedInDbListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BlogDataSavedInDbEvent $event): void
    {
        if($event->cache_key) {
            Cache::forget($event->cache_key);
        } else {
            Cache::flush();
        }
    }
}
