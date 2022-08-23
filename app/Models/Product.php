<?php

namespace App\Models;

use App\Models\Menus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function menus()
    {
        return $this->hasOne(Menus::class,'id', 'menu_id' );
    }
}
