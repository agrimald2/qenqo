<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_rate_id',
        'total_payed',
        'payment_status_id',
        'added_by',
        'payment_method',
    ];

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function customerRate()
    {
        return $this->belongsTo(CustomerRate::class);
    }
}