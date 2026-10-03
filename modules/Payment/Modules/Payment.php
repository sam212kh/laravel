<?php

namespace Modules\Payment\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Payment\Database\Factories\PaymentFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_in_cents', 'status', 'payment_gateway', 'payment_id', 'user_id', 'order_id'
    ];

    protected static function newFactory() : PaymentFactory
    {
        return new PaymentFactory();
    }
}
