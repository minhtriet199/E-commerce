<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification as Notify;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DeleteNoti extends Command
{
    protected $signature = 'command:DeleteNoti';

    protected $description = 'Command description';

    public function handle()
    {
       Notify::where('created_at','<=',Carbon::now()->subDays(7))
       ->where('active',0)
       ->delete();
    }
}
