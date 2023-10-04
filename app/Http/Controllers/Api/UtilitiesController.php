<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Modality;
use App\Models\PaymentMethod;
use Log;

class UtilitiesController extends Controller
{  
    public function getRoles(){
        $data = Role::all();
        return response()->json($data, 200);
    }
    public function getModalities(){
        $data = Modality::all();
        return response()->json($data, 200);
    }
    public function getPaymentMethods(){
        $data = PaymentMethod::all();
        return response()->json($data, 200);
    }
}
