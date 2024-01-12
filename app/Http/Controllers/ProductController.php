<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use App\Models\ProductPlan;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('list', Products::class);

        // Check if the user has the 'admin' role
        if (Auth()->user()->hasRole('admin')) {
            $products = Products::all();
        } else {
            // For non-admin users, only fetch their own customers
            $products = Products::where('created_by', Auth()->id())->get();
        }

        return view('products.index', compact('products'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store', Products::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {
                $plan = new Products();

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
    public function show(Products $customer, $id)
    {
        $this->authorize('view', $customer);

        $product  = Products::findOrFail($id);

        $productPlan = ProductPlan::where('product_id', $id)->with('plan')->get();

        if (Auth()->user()->hasRole('admin')) {
            $plans  = Plans::all();
        } else {
            $plans  = Plans::where('created_by', Auth()->id())->get();
        }
        // If the execution reaches here, it means the user is authorized
        // Perform actions specific to showing the customer

        return view('products.show', compact('product', 'plans', 'productPlan'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $plan, $id)
    {
        $this->authorize('edit', $plan);

        $product  = Products::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $plan = Products::findOrFail($id);

            $this->authorize('update', $plan);

            $plan->name = $request->name;
            $plan->value = $request->value;
            $plan->save();

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
        $this->authorize('destroy', new Products());
        try {
            Products::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function asignPlan(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'plan' => ['required', 'string', 'max:255']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            $check_val = ProductPlan::where('plan_id', $request->plan)
                ->where('product_id', $id)->get();
            if (count($check_val) === 0) {
                try {
                    $productPlan = new ProductPlan();
                    $productPlan->product_id = $id;
                    $productPlan->plan_id = $request->plan;
                    $productPlan->save();

                    return redirect()->back()->with('message', 'Asigned successfully');
                } catch (\Exception $e) {
                    return redirect()->back()->with(['error' => $e->getMessage()]);
                }
            } else {
                return redirect()->back()->with(['error' => 'Plan already asigned']);
            }
        }
    }


    public function unAsignPlan(string $id)
    {
        try {
            ProductPlan::findOrFail($id)->delete();

            return redirect()->back()->with('message', 'Plan removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
