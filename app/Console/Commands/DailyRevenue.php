<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DailyRevenue as RevenueModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyRevenue extends Command
{
    protected $signature = 'command:daily';

    protected $description = 'Command description';

    public function handle()
    {
        RevenueModel::create([
            'revenue' => DB::table('Orders')
                ->whereDate('created_at', Carbon::today())
                ->sum('total'),
            'order' => DB::table('Orders')
                ->whereDate('created_at', Carbon::today())
                ->count(),
        ]);
    }
}
