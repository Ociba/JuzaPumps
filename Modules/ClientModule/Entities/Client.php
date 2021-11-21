<?php

namespace Modules\ClientModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class Client extends Model
{
    use HasFactory, SoftDeletes, Prunable;
     
    protected $guarded = [];
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ClientModule\Database\factories\ClientFactory::new();
    }
}
