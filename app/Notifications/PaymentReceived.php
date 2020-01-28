<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class PaymentReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            # Email subject message
            ->subject('Your Laracasts Payment Was received')
            # Greeting is the headline
            ->greeting("What's Up?")
            # line represents the paragraph
            ->line('The introduction to the notification.')
            ->line('Lorem ipsum dolor sit amet, consectetur adipisicing elit.')
            # Represents the call to action button
            ->action('Sign Up', url('/'))
            # Another Paragraph
            ->line('Thanks!');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Your Laracasts payment has been processed!');
            #-> from()  #if per used basis want to change where text messages been sent from
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
            'amount' => $this->amount
        ];
    }
}
