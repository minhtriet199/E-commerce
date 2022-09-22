<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cart_item;

class Cart extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'user_id',
        'user_name',
        'voucher',
        'total',       
    ];

    public function users(){
        return $this->belongsto(User::class,'id', 'user_id' );
    }
    
    public function cart_items(){
        return $this->hasMany(Cart_item::class,'cart_id','id');
    }
}
