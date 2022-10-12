<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MonthlyRevenue as RevenueModel;
use App\Http\Services\Order\OrderServices;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonthlyRevenue extends Command
{
    protected $signature = 'command:monthly';

    protected $description = 'Command description';

    public function handle()
    {
        RevenueModel::create([
            'revenue' => DB::table('Orders')
                ->whereDate('created_at', Carbon::now()->month)
                ->sum('total'),
            'order' => DB::table('Orders')
                ->whereDate('created_at', Carbon::now()->month)
                ->count(),
        ]);
    }
}
