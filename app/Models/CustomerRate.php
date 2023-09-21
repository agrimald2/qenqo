<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CustomerRate;
use App\Models\CustomerRateStatus;

class CustomerRate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'rate_name',
        'rate_description',
        'rate_total_price',
        'rate_total_sessions',
        'nutritional_assessment_total',
        'max_freeze_days',
        'start_day',
        'end_day',
        'added_by',
    ];
    

    public function customer()
    {
        return $this->belongsTo(CustomerRate::class);
    }

    public function status()
    {
        return $this->belongsTo(CustomerRateStatus::class);
    }
}

