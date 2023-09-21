<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\SubFamily;
use Log;


class SubFamilyController extends Controller
{
    public function index()
    {
        $breadcrumbs = [["name" => "Subfamilias", "href" => "/admin/incidents"]];
        return Inertia::render('Subfamilies/Index', [
            'breadcrumbs' => $breadcrumbs,
        ]);    
    }

    public function getSubFamilies(Request $request)
    {      
        $name = $request->get('name');
        $family_id = $request->get('family_id');
        $data = SubFamily::with('family')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->when($family_id, function ($query, $family_id) {
                return $query->where('family_id', $family_id);
            })
            ->get();

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $subfamily = new SubFamily;
        $subfamily->name = $request->name;
        $subfamily->is_enabled = $request->is_enabled;
        $subfamily->required_admin_permission = $request->required_admin_permission;
        $subfamily->save();

        return response()->json($subfamily);
    }

    public function update(Request $request, $id)
    {
        $subfamily->name = $request->name;
        $subfamily->is_enabled = $request->is_enabled;
        $subfamily->required_admin_permission = $request->required_admin_permission;
        $subfamily->save();

        return response()->json($subfamily);
    }

    public function destroy(Request $request, $id)
    {
        $subfamily = SubFamily::find($id);
        if ($subfamily) {
            $subfamily->delete();
            return response()->json(['message' => 'SubFamily deleted successfully']);
        } else {
            return response()->json(['message' => 'SubFamily not found'], 404);
        }
    }
}