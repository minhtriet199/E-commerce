<?php

namespace App\Http\Services;

use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\OrderMail;

class MailServices{

    public function sendOrderMail($order){
        Mail::to($order->email)->send(new OrderMail($order));
    }
}
