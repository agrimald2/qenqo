<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'is_enabled',
        'required_admin_permission',
    ];

    public function subfamilies()
    {
        return $this->hasMany('App\Models\Subfamily');
    }
}

