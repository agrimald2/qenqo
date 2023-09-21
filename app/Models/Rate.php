<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'subfamily_id',
        'name',
        'description',
        'price',
        'stock',
        'duration',
        'haveDiet',
        'nutritional_assessments',
        'max_freeze_days',
    ];

    public function subfamily()
    {
        return $this->belongsTo(Subfamily::class);
    }
}

