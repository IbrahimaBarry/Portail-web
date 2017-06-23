<?php

namespace App\Listeners;

use App\Events\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Notifications\Alert;

class SendNotification
{
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
     * @param  Notification  $event
     * @return void
     */
    public function handle(Notification $event)
    {
        $users = User::where('groupe_id', '!=', 1)->get();
        foreach ($users as $user) {
            $user->notify(new Alert());
        }
    }
}
