<?php

namespace Modules\ClientModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ['region'];
    
    protected static function newFactory()
    {
        return \Modules\ClientModule\Database\factories\RegionFactory::new();
    }
}
