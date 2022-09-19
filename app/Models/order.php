<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_detail;
use App\Models\Product;
use App\models\User;

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

    public function order_details(){
        return $this->hasMany(Order_detail::class,'order_id','id');
    }

}
