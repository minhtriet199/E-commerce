<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\Order;
use App\Mail\OrderMail;

class sendMailOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Order  $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function handle()
    {
        $order = $this->order;
        $email =new OrderMail($order);
        Mail::to($order->email)->send($email);
    }
}
