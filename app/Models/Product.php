<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menus;
use App\Models\Product_image;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'name',
        'slug',
        'description',
        'thumb',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'amount',
    ];
    
    public function menus(){
        return $this->hasOne(Menus::class,'id', 'menu_id' );
    }
    public function product_image(){
        return $this->hasMany(Product_image::class);
    }
}
