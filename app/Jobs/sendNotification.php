<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Notifications\ResetPassword;
use App\Models\User;


class sendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $password;
    public User $user;

    public function __construct(User $user,$password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function handle()
    {
        $password = $this->password;
        $mail =new ResetPassword($password->token);
        Mail::to($user->email)->send($mail);
    }
}
