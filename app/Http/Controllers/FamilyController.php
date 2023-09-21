<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Family;
use Log;


class FamilyController extends Controller
{
    public function index()
    {
        $breadcrumbs = [["name" => "Familias", "href" => "/admin/incidents"]];
        return Inertia::render('Families/Index', [
            'breadcrumbs' => $breadcrumbs,
        ]);    
    }

    public function getFamilies(Request $request)
    {      
        $name = $request->get('name');
        $data = Family::when($name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $family = new Family;
        $family->name = $request->name;
        $family->is_enabled = $request->is_enabled;
        $family->required_admin_permission = $request->required_admin_permission;
        $family->save();

        return response()->json($family);
    }

    public function update(Request $request, $id)
    {
        $family = Family::find($id);
        $family->name = $request->name;
        $family->is_enabled = $request->is_enabled;
        $family->required_admin_permission = $request->required_admin_permission;
        $family->save();

        return response()->json($family);
    }

    public function destroy(Request $request, $id)
    {
        $family = Family::find($id);
        if ($family) {
            $family->delete();
            return response()->json(['message' => 'Family deleted successfully']);
        } else {
            return response()->json(['message' => 'Family not found'], 404);
        }
    }
}