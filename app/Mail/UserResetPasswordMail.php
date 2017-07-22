<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $userName;
    public $email;
    public $subject = "Wazir - Password Reset";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $userName, $email)
    {
        $this->token = $token;
        $this->userName = $userName;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.reset_password');
    }
}
