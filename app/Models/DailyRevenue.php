<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRevenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'revenue',
        'order',
    ];
}
