<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\CustomerRate;
use Log;

class CustomerRatesController extends Controller
{
    public function addRateToCustomer(Request $request){
        $user = auth()->user();
        $rate = Rate::find($request->rate_id);
        $username = 'Cliente';

        Log::debug($request);
        Log::debug($rate);

        if($user){
            $username = $user->name;
        }

        $customerRate = CustomerRate::create([
            'customer_id' => $request->customer_id,
            'rate_name' => $rate->name,
            'rate_description' => $rate->description,
            'rate_total_price' => $rate->price,
            'rate_total_sessions' => $rate->stock,
            'nutritional_assessment_total' => $rate->nutritional_assessments,
            'max_freeze_days' => $rate->max_freeze_days,
            'start_day' => $request->start_day,
            'end_day' => $request->end_day,
            'added_by' => $username,
        ]);
    
        return response()->json(['message' => 'Customer rate added successfully.'], 200);
    }

    public function getCustomerRate(Request $request){
        $customerRate = CustomerRate::find($request->id);

        if(!$customerRate){
            return response()->json(['message' => 'Customer rate not found.'], 404);
        }

        return response()->json($customerRate, 200);
    }
    
}

