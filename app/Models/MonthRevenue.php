<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthRevenue extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'Revenue',
        'Order',
    ];
}
