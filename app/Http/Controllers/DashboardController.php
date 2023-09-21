<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function getAuthUserInformation(Request $request)
    {
        $user = $request->user();
        $user->load('role');
        return response()->json($user);
    }
    
}
