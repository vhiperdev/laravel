<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use App\Models\ResellerPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResellerPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list', ResellerPlan::class);

        if (Auth()->user()->hasRole('admin')) {
            $plans = ResellerPlan::all();
        } else {
            $plans  = ResellerPlan::where('created_by', Auth()->id())->get();
        }

        return view('reseller_plans.index', compact('plans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store', ResellerPlan::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {
                $plan = new ResellerPlan();

                $plan->name = $request->name;
                $plan->value = $request->value;
                $plan->created_by = auth()->user()->id;
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
    public function show(ResellerPlan $customer, $id)
    {
        $this->authorize('view', $customer);

        $plan  = ResellerPlan::findOrFail($id);
        // If the execution reaches here, it means the user is authorized
        // Perform actions specific to showing the customer

        return view('reseller_plans.show', compact('plan'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResellerPlan $plan, $id)
    {
        $this->authorize('edit', $plan);

        $plan  = ResellerPlan::findOrFail($id);

        return view('reseller_plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $plan = ResellerPlan::findOrFail($id);

            $this->authorize('update', $plan);

            $plan->name = $request->name;
            $plan->value = $request->value;
            $plan->save();

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('destroy', new Plans());
        try {
            ResellerPlan::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
