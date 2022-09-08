<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'id',
        'user_id',
        'voucher_id',
        'status',
        'total',
        'email',
        'username',
        'address',
        'phone',     
    ];
}
