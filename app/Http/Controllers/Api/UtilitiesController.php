<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Modality;
use Log;

class UtilitiesController extends Controller
{  
    public function getRoles(){
        $roles = Role::all();
        return response()->json($roles, 200);
    }
    public function getModalities(){
        $modalities = Modality::all();
        return response()->json($modalities, 200);
    }
}
