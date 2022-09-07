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
        return $this->belongsto(Cities::class,'city_id', 'id' );
    }
    public function district()
    {
        return $this->belongsto(District::class,'district_id', 'id' );
    }
}
