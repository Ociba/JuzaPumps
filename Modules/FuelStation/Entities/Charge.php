<?php

namespace Modules\FuelStation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = ['fuel_station_id','client_id','charge'];
    
    protected static function newFactory()
    {
        return \Modules\FuelStation\Database\factories\ChargeFactory::new();
    }
}
