<?php namespace SleepingOwl\Admin\Listeners;

use SleepingOwl\Admin\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        debug("listener construct");
    }

    /**
     * Handle the event.
     *
     * @param  KeyfinderWasCreated  $event
     * @return void
     */
    public function handle(UserEvent $event)
    {
        debug("listener handle");
        
    }
}