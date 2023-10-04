<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRateStatus extends Model
{
    use HasFactory;

    public function rates()
    {
        return $this->hasMany(CustomerRate::class);
    }
}

