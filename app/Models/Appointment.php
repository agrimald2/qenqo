<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Models\Customer;
use App\Models\Modality;
use App\Models\User;
use App\Models\Branch;
use App\Models\AppointmentStatus;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function appointmentStatus()
    {
        return $this->belongsTo(AppointmentStatus::class, 'appointments_status_id');
    }
}

