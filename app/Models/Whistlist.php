<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Whistlist extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'user_id',
        'product_id',
        'quantity',
    ];

    public function products(){
        return $this->hasMany(Product::class,'id', 'product_id' );
    }
}
