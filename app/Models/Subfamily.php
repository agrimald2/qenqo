<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Family;
use App\Models\Rate;

class Subfamily extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'family_id',
        'name',
        'is_enabled',
        'required_admin_permission',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }
    
}

