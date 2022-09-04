<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 
class Menus extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'name',
        'slug',
        'content',
        'active',
        'updated_at'
        
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'menu_id', 'id');
    }
}
