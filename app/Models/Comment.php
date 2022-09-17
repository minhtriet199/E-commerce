<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;

class Comment extends Model
{
    use HasFactory;

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
}
