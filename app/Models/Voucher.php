<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'voucher_code',
        'discount',
        'quantity',
        'expire_date',
        'active'
    ];

    protected $casts = [
        'expire_date' => 'datetime',
     ];
}
