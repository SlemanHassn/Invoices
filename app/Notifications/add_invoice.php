<?php

namespace App\Notifications;

use App\Models\invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class add_invoice extends Notification
{
    use Queueable;
    private $invoice;
    public function __construct(invoice $invoice)
    {
        $this->invoice = $invoice;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return[
            'invoice_id' => $this->invoice->id,
            'title'      => 'تم اضافة فاتورة جديدة بواسطة ',
            'User'       => auth()->user()->name,
        ];
        }


}
