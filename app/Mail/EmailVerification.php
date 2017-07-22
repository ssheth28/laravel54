<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    public $subject = "Wazir - Email Verification";

    /**
     * Create a new message instance.
     *
     *
     * @param mixed $user
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verification')->with([
            'verification_token' => $this->user->verification_token,
        ]);
    }
}
