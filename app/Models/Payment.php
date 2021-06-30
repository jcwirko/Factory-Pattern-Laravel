<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'status',
        'amount',
        'products',
        'detail',
        'payment_platform_id',
        'user_id'
    ];

    protected $casts = [
        'products' => 'array'
    ];
}
