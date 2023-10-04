<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\CustomerRate;
use App\Models\CustomerPayment;
use Log;

class CustomerRatesController extends Controller
{
    public function addRateToCustomer(Request $request){
        $user = auth()->user();
        $rate = Rate::find($request->rate_id);
        $username = 'Cliente';

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

    public function showCustomerRate($id){
        $customer_rate = CustomerRate::with(['customer', 'status', 'customerPayments' => function($query) {
            $query->withTrashed();
        }, 'customerPayments.paymentStatus'])->find($id);
        $customer = Customer::find($customer_rate->customer_id);

        $breadcrumbs = [["name" => "Clientes", "href" => "/customers"],["name" => $customer->name, "href" => "/customers"], ["name" => $customer_rate->rate_name, "href" => "/customers/rates/".$customer_rate->id]];
        return Inertia::render('CustomerRates/CustomerRatePayments', [
            'breadcrumbs' => $breadcrumbs,
            'customer_rate' => $customer_rate
        ]); 
    }

    public function showCustomerRates($id){
        $customer = Customer::find($id);
        $customer_rates = CustomerRate::with('status')->where('customer_id', $customer->id)->get();

        $breadcrumbs = [["name" => "Clientes", "href" => "/customers"],["name" => $customer->name, "href" => "/customers"], ["name" => 'Tarifas', "href" => "/customers/".$customer->id.'/rates']];
        return Inertia::render('CustomerRates/CustomerRates', [
            'breadcrumbs' => $breadcrumbs,
            'customer_rates' => $customer_rates
        ]); 
    }

    public function addPaymentToCustomerRate(Request $request){
        $payment = new CustomerPayment;
        
        $user = auth()->user();
        Log::debug($user);
        $username = 'Cliente';

        if($user){
            $username = $user->name;
        }

        $payment->customer_rate_id = $request->customer_rate_id;
        $payment->total_payed = $request->total_payed;
        $payment->added_by = $username;
        $payment->payment_method = $request->payment_method;
        $payment->save();

        $this->sumPaymentOnCustomerRate($request->customer_rate_id, $request->total_payed);
        
        return response()->json(['message' => 'Payment added successfully.'], 200);
    }
    
    private function sumPaymentOnCustomerRate($customer_rate_id, $payment){
        $customer_rate = CustomerRate::find($customer_rate_id);
        if($customer_rate){
            $customer_rate->total_payed = $customer_rate->total_payed + $payment;
            $customer_rate->save();
        }
        return;
    }

    public function deletePaymentToCustomerRate($id){
        $payment = CustomerPayment::find($id);
        
        if($payment){
            $this->substractPaymentOnCustomerRate($payment->customer_rate_id, $payment->total_payed);
            $payment->payment_status_id = 2;
            $payment->save();
            $payment->delete();
        }

        return response()->json(['message' => 'Payment deleted successfully.'], 200);
    }

    private function substractPaymentOnCustomerRate($customer_rate_id, $payment){
        $customer_rate = CustomerRate::find($customer_rate_id);
        if($customer_rate){
            $customer_rate->total_payed = $customer_rate->total_payed - $payment;
            $customer_rate->save();
        }
        return;
    }
}

