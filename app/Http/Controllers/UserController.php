<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Log;

class UserController extends Controller
{
    public function index()
    {
        $breadcrumbs = [["name" => "Users", "href" => "/users"]];
        return Inertia::render('Users/Index', [
            'breadcrumbs' => $breadcrumbs,
        ]);    
    }

    public function getUsers(Request $request)
    {      
        $name = $request->get('name');
        $role_id = $request->get('role_id');

        $data = User::with('role')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->when($role_id, function ($query, $role_id) {
                return $query->where('role_id', $role_id);
            })
            ->get();

        return response()->json($data, 200);
    }
}