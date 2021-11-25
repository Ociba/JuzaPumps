<?php

namespace Modules\FuelStation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelStation extends Model
{
    use HasFactory;
   protected $guarded =[];
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\FuelStation\Database\factories\FuelStationFactory::new();
    }
}
