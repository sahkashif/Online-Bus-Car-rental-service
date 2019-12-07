<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use App\Order;

class ConfirmationTicket extends Notification
{
    use Queueable;
    
    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['nexmo'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/');

        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('One of your invoices has been paid!')
                    ->action('View Invoice', $url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toNexmo($notifiable)
    {
        $userName = $this->order->user()->pluck('name');
        $order = $this->order->id;
        $bus = $this->order->bus_id;
        $seats= $this->order->seats();
        $depTime = $this->order->dep_time;
        $from = $this->order->start_stop_name();
        $to = $this->order->end_stop_name();

        $message = "Dear ".$userName.", Your Ticket[ID:".$order."] has been confirmed for traveling from ".$from." to ".$to." with Bus_Id:".$bus." . Your deperture time is ".date("d M Y, D :: h:i A",strtotime($depTime)).". Thank you for your purchase"; 
        return (new NexmoMessage())
                ->content($message);
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
