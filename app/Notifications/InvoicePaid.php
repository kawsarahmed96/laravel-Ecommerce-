<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    protected $order;
    protected $invoiceName;
    protected $invoiceOutput;

    /**
     * Create a new notification instance.
     */
    public function __construct($order_details, $invoiceName, $invoiceOutput)
    {
        //
        $this->order = $order_details;
        $this->invoiceName   = $invoiceName;
        $this->invoiceOutput = $invoiceOutput;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!')
            ->line('order Price'.$this->order->total_price)
            ->attachData($this->invoiceOutput, $this->invoiceName, [
                'mime' =>'aplication/pdf',
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
