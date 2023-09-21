<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $breadcrumbs = [["name" => "Clientes", "href" => "/customers"]];
        return Inertia::render('Customers/Index', [
            'breadcrumbs' => $breadcrumbs,
        ]);    
    }

    /** Validate if the customer exist on our db */
    public function validateDNI($dni){
        $customer = Customer::where('dni', $dni)->first();
        return $customer ? response()->json(['message' => 'Customer exists'], 200) : response()->json(['message' => 'Customer does not exist'], 404);
    }
    /** Get list of customers with a search query by name, lastname, dni or phone */
    public function getCustomers(Request $request)
    {
        $query = $request->get('query');
        
        $customers = Customer::where('name', 'like', "%{$query}%")
            ->orWhere('lastname', 'like', "%{$query}%")
            ->orWhere('dni', 'like', "%{$query}%")
            ->orWhere('phone', 'like', "%{$query}%")
            ->get();

        // Loop through the customers and load their last rate
        foreach ($customers as $customer) {
            $customer->load('lastCustomerRate'); // Assuming you defined the relationship as 'lastCustomerRate'
        }

        return response()->json($customers, 200);
    }

    public function store(Request $request){
        $customer = Customer::where('dni', $request->dni)->first();
        if($customer){
            return response()->json(['message' => 'Customer already exists'], 409);
        }
        $newCustomer = Customer::create($request->all());
        $request['token'] = $this->generateToken($newCustomer->id);
        $newCustomer->token = $request['token'];
        $newCustomer->save();
        return response()->json($newCustomer, 201);
    }
    
    private function generateToken($id){
        $random = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4);
        return $id."-".$random;
    }
    
    public function update(Request $request, $id){
        $customer = Customer::find($id);
        if(!$customer){
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->update($request->except('dni'));
        return response()->json($customer, 200);
    }
    
}

