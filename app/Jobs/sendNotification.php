<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Mail;
use App\Notifications\ResetPassword;
use App\Models\Password_reset;
use App\Models\User;



class sendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public Password_reset $password;
    public User $user;

    public function __construct(User $user,Password_reset $password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function handle()
    {
        $password = $this->password;
        $mail =new ResetPassword($password->token);
        Notification::route('mail',$this->user->email)->notify(new ResetPassword($password->token));
    }
}

