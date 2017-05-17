<?php

namespace App\Jobs;

use App\Mail\InviteUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendInvitationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userInvite;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userInvite, $user)
    {
        $this->userInvite = $userInvite;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new InviteUser($this->userInvite);
        Mail::to($this->user->email)->send($email);
    }
}
