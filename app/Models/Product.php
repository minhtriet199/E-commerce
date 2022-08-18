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
        'description',
        'thumb',
        'content',
        'menu_id',
        'active',
        'price',
        'price_sale',
        'slug'
    ];
    
    public function menu()
    {
        return $this->hasOne(Menus::class,'id', 'menu_id' );
    }
}
