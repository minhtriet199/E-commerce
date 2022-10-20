<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MonthRevenue as RevenueModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonthlyRevenue extends Command
{
    protected $signature = 'command:monthly';

    protected $description = 'Command description';

    public function handle()
    {
        RevenueModel::create([
            'Revenue' => DB::table('Orders')
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('total'),
            'Order' => DB::table('Orders')
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
        ]);
    }
}
