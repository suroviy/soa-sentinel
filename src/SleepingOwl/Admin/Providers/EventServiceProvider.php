<?php namespace SleepingOwl\Admin\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'SleepingOwl\Admin\Events\UserEvent' => [
            'SleepingOwl\Admin\Listeners\UserListener'
        ],
    ];

    public function register() {
        \Event::listen('SleepingOwl\Admin\Events\UserEvent', function($event)
        {

            foreach ($event->model->items() as $group => $items) {
                
                foreach ($items as $key => $item) {
                
                    //ignore Roles field
                    if( $item instanceof \SleepingOwl\Admin\FormItems\Roles ) {
                        continue;
                    }
                    //ignore Permissions field
                    if( $item instanceof \SleepingOwl\Admin\FormItems\Permissions ) {
                        continue;
                    }

                    $value = $item->save();
                }
            }

            $created = $event->model->instance()->save();

            //update the current record and add roles and permissions
            $items = $event->model->items();
            array_walk_recursive($items, function ($item)
            {
                $item->save();
            });

            $update = $event->model->instance()->save();


        });
    }
   
}