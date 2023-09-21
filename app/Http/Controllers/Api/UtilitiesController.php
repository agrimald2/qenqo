<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UtilitiesController extends Controller
{  
    public function getRoles(){
        $roles = Role::all();
        return response()->json($roles, 200);
    }
}
