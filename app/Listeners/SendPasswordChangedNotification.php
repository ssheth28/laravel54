<?php

namespace App\Listeners;

use App\Events\ChangePassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Hash;
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
     * @param  ChangePassword  $event
     * @return void
     */
    public function handle(ChangePassword $event)
    {
        
    }
}
