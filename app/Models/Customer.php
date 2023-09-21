<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CustomerRate;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'dni',
        'name',
        'lastname',
        'phone',
        'token',
        'birthdate',
        'sex',
    ];

    public function customerRates()
    {
        return $this->hasMany(CustomerRate::class);
    }

    /**
     * Get the last customer rate for this customer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function LastCustomerRate()
    {
        return $this->hasOne(CustomerRate::class)->latest();
    }
}