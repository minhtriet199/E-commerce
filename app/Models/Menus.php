<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

 
class Menus extends Model
{
    use HasFactory;
    use SoftDeletes;
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
