<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\UserResetPasswordMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * User name
     *
     * @var string
     */
    public $userName;

    /**
     * Recipient email
     *
     * @var string
     */
    public $recipientEmail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $name, $recipientEmail)
    {
        $this->token = $token;
        $this->userName = $name;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new UserResetPasswordMail($this->token, $this->userName, $this->recipientEmail))->to($this->recipientEmail);
        // return (new MailMessage)
        //     ->line('You are receiving this email because we received a password reset request for your account.')
        //     ->action('Reset Password', url('password/reset', $this->token))
        //     ->line('If you did not request a password reset, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
