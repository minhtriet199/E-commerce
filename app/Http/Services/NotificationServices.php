<?php

namespace App\Http\Services;

use App\Models\Notifications;


class NotificationServices{
    public function get(){
        return Notification::Limit(5)
            ->get();
    }
}
