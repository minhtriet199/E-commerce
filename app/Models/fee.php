<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cities;
use App\Models\District;

class fee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =
    [
        'id',
        'city_id',
        'district_id',
        'fee',       
    ];

    public function city()
    {
        return $this->belongto(Cities::class,'id', 'city_id' );
    }
    public function district()
    {
        return $this->belongto(District::class,'id', 'district_id' );
    }
}
