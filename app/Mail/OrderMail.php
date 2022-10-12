<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\order;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public Order $order;
     
    public function __construct($order)
    {
        $this ->order = $order;
    }

    public function build()
    {
        return $this->subject('Order Confirm')->view('mails.order_mail',[
            'title' => 'confirm',
        ]);
    }
}
