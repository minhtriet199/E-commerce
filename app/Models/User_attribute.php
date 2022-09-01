<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'name',
        'address',
        'city',
        'phone',
    ];
    
    public function users()
    {
        return $this->hasOne(User_attribute::class,'id', 'user_id' );
    }

}
