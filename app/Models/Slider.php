<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'id',
        'name',
        'url',
        'thumb',
        'description',
        'sort_by',
        'active',
    ];
    
}
