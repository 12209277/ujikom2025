<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Sale extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'product_data' => 'array'
    ];
    
    protected $fillable = [
        'invoice_number',
        'customer_name',
        'user_id',
        'member_id',
        'product_data',
        'total_amount',
        'payment_amount',
        'change_amount',
        'notes',
        'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
