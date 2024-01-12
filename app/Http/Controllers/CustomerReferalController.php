<?php

namespace App\Http\Controllers;

use App\Models\CustomerReferal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerReferalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_referals = CustomerReferal::all();
        return view('settings.customer_referals', compact('customer_referals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'cost_per_customer' => ['required', 'string', 'max:255'],
            'amount_earned' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {
                $plan = new CustomerReferal();

                $plan->name = $request->name;
                $plan->cost_per_customer = $request->cost_per_customer;
                $plan->amount_earned = $request->amount_earned;
                $plan->save();

                return redirect()->back()->with('message', 'Created successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $requestData = $request->except('_token', 'id');
            CustomerReferal::findOrFail($request->id)->update($requestData);

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            CustomerReferal::findOrFail($id)->delete();

            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
