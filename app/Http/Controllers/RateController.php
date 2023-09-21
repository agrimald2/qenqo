<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\SubFamily;
use App\Models\Rate;
use Log;
class RateController extends Controller
{
    public function index()
    {
        $breadcrumbs = [["name" => "Tarifas y Planes", "href" => "/rates"]];
        return Inertia::render('Rates/Index', [
            'breadcrumbs' => $breadcrumbs,
        ]);    
    }

    public function store(Request $request)
    {
        $rate = new Rate;
        $rate->subfamily_id = $request->subfamily_id;
        $rate->name = $request->name;
        $rate->description = $request->description;
        $rate->price = $request->price;
        $rate->stock = $request->stock;
        $rate->duration = $request->duration;
        $rate->haveDiet = $request->haveDiet;
        $rate->nutritional_assessments = $request->nutritional_assessments;
        $rate->max_freeze_days = $request->max_freeze_days;
        $rate->save();

        return response()->json($rate, 201);
    }
    public function update(Request $request, $id)
    {
        $rate = Rate::find($id);
        $rate->subfamily_id = $request->subfamily_id;
        $rate->name = $request->name;
        $rate->description = $request->description;
        $rate->price = $request->price;
        $rate->stock = $request->stock;
        $rate->duration = $request->duration;
        $rate->haveDiet = $request->haveDiet;
        $rate->nutritional_assessments = $request->nutritional_assessments;
        $rate->max_freeze_days = $request->max_freeze_days;
        $rate->save();

        return response()->json($rate, 200);
    }
    
    public function getRates(Request $request)
    {
        $name = $request->get('name');
        $rates = Rate::with(['subfamily' => function ($query) {
            $query->withTrashed();
        }])->when($name, function ($query, $name) {
            return $query->where('name', 'like', "%{$name}%");
        })->get();
        return response()->json($rates, 200);
    }

    public function destroy(Request $request, $id)
    {
        $rate = Rate::find($id);
        if($rate){
            $rate->delete();
            return response()->json(null, 204);
        }
        return response()->json(null, 404);
    }
    
    
}
