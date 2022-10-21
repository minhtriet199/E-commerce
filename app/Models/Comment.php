<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\Product;

class Comment extends Model
{
    use HasFactory;
    use softDeletes;
    
    protected $fillable =[
        'id',
        'user_id',
        'product_id',
        'Content', 
        'updated_at'
    ];
    
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
