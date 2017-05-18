<?php

namespace App\Listeners;

use App\Events\ChangePassword;

class SendPasswordChangedNotification
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
     * @param ChangePassword $event
     *
     * @return void
     */
    public function handle(ChangePassword $event)
    {
    }
}
