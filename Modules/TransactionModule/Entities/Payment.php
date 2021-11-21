<?php

namespace Modules\TransactionModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class Payment extends Model
{
    use HasFactory, softDeletes, Prunable;
    
    protected $guarded =[];
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\TransactionModule\Database\factories\PaymentFactory::new();
    }
}
