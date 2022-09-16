<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Chúng tôi nhận được yêu cầu thiết lập lại mật khẩu cho tài khoản của bạn')
                    ->action('Tiếp theo', url('user/change_pass', $this->token))
                    ->line('Cảm ơn đã sử dụng dịch vụ của chúng tôi!');
    }

}
