<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Modality;
use App\Models\Branch;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'week_day',
        'start_time',
        'end_time',
        'modality_id',
        'branch_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}

