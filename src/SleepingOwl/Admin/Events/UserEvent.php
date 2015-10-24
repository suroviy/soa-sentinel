<?php namespace SleepingOwl\Admin\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use SleepingOwl\Admin\Form\FormDefault;

class UserEvent extends Event
{
    use SerializesModels;

    public $model;
    public $inputs;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FormDefault $formModel, $formInput)
    {
        $this->model = $formModel;
        $this->inputs = $formInput;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}