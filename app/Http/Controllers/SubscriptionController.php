<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use App\Models\ProductPlan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('list', Subscription::class);

        if (Auth()->user()->hasRole('admin')) {
            $subscriptions = Subscription::where('customer_id', '!=', NULL)->get();
        } else {
            $subscriptions = Subscription::where('customer_id', '!=', NULL)
                ->whereHas('customer', function ($query) {
                    $query->whereHas('createdByUser', function ($subquery) {
                        // Use the hasRole method to check if the creator has the 'reseller' role
                        $subquery->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'reseller');
                        });
                    });
                })->get();
        }


        $pageTitle = 'All Subscription';

        return view('subscriptions.index', compact('subscriptions', 'pageTitle'));
    }

    public function active(Request $request)
    {
        if (Auth()->user()->hasRole('admin')) {
            $subscriptions = Subscription::where('active_status', 1)->where('customer_id', '!=', NULL)->get();
        } else {
            $subscriptions = Subscription::where('active_status', 1)->where('customer_id', '!=', NULL)
                ->whereHas('customer', function ($query) {
                    $query->whereHas('createdByUser', function ($subquery) {
                        // Use the hasRole method to check if the creator has the 'reseller' role
                        $subquery->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'reseller');
                        });
                    });
                })->get();
        }

        $pageTitle = 'Active Subscriptions';

        return view('subscriptions.index', compact('subscriptions', 'pageTitle'));
    }

    public function inactive(Request $request)
    {
        if (Auth()->user()->hasRole('admin')) {
            $subscriptions = Subscription::where('active_status', 0)->where('customer_id', '!=', NULL)->get();
        } else {
            $subscriptions = Subscription::where('active_status', 0)->where('customer_id', '!=', NULL)
                ->whereHas('customer', function ($query) {
                    $query->whereHas('createdByUser', function ($subquery) {
                        // Use the hasRole method to check if the creator has the 'reseller' role
                        $subquery->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'reseller');
                        });
                    });
                })->get();
        }

        $pageTitle = 'Inactive Subscriptions';

        return view('subscriptions.index', compact('subscriptions', 'pageTitle'));
    }

    public function due_this_month(Request $request)
    {
        $yesterday = now()->subDay();
        $currentMonthEnd = now()->endOfMonth();

        if (Auth()->user()->hasRole('admin')) {
            $subscriptions = Subscription::where('active_status', 1)
                ->whereBetween('next_due_date', [$yesterday, $currentMonthEnd])
                ->get();
        } else {
            $subscriptions = Subscription::where('active_status', 1)
                ->where('customer_id', '!=', NULL)
                ->whereBetween('next_due_date', [$yesterday, $currentMonthEnd])

                ->whereHas('customer', function ($query) {
                    $query->whereHas('createdByUser', function ($subquery) {
                        // Use the hasRole method to check if the creator has the 'reseller' role
                        $subquery->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'reseller');
                        });
                    });
                })->get();
        }


        $pageTitle = 'Subscription Due This Month';

        return view('subscriptions.index', compact('subscriptions', 'pageTitle'));
    }

    public function over_due(Request $request)
    {
        $yesterday = now()->subDay(); // Get yesterday's date.

        if (Auth()->user()->hasRole('admin')) {
            $subscriptions = Subscription::where('active_status', 1)
                ->where('next_due_date', '<=', $yesterday)
                ->get();
        } else {
            $subscriptions = Subscription::where('active_status', 1)
                ->where('customer_id', '!=', NULL)
                ->where('next_due_date', '<=', $yesterday)

                ->whereHas('customer', function ($query) {
                    $query->whereHas('createdByUser', function ($subquery) {
                        // Use the hasRole method to check if the creator has the 'reseller' role
                        $subquery->whereHas('roles', function ($roleQuery) {
                            $roleQuery->where('name', 'reseller');
                        });
                    });
                })->get();
        }

        $pageTitle = 'Subscription Over Due';

        return view('subscriptions.index', compact('subscriptions', 'pageTitle'));
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
    public function store(Request $request, $id)
    {
        $this->authorize('store', Subscription::class);

        $validator = Validator::make($request->all(), [
            'product' => ['required', 'string', 'max:255'],
            'product_plan_id' => ['required', 'string', 'max:255'],
            'subscription_duration' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {

                $nextTime = Carbon::createFromTimestamp(
                    $this->getNextTime($request->subscription_duration)
                );

                $subscrition = new Subscription();
                $subscrition->product_plan_id = $request->product_plan_id;
                $subscrition->customer_id = $id;
                $subscrition->next_due_date = $nextTime;
                $subscrition->subscription_duration = $request->subscription_duration;
                $subscrition->save();

                return redirect()->back()->with('message', 'Subscription created successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }

    protected function getNextTime($subscription_duration)
    {
        $now = Carbon::now();

        switch (true) {
            case $subscription_duration === 'monthly':
                return $now->addMonth()->timestamp;
                break;
            case $subscription_duration === 'quarterly':
                return $now->addMonths(3)->timestamp;
                break;
            case $subscription_duration === 'anually':
                return $now->addMonth(12)->timestamp;
                break;
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
        $subscription = Subscription::with('customer')->with('productplan')->findOrFail($id);
        $productplan = ProductPlan::where("product_id", $subscription->productplan->product->id)->with('plan')->get();

        return view('subscriptions.edit', compact('subscription', 'productplan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->authorize('update', new Subscription());

        try {
            $subscription = Subscription::findOrFail($id);

            $subscription->subscription_duration = $request->subscription_duration;
            $subscription->save();

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function disable(string $id)
    {
        try {
            $disable = Subscription::findOrFail($id)->update(['active_status' => 0]);
            if ($disable) {
                return redirect()->back()->with('message', 'Subscription disabled successfully!');
            } else {
                return redirect()->back()->with('error', 'Unable to disable subscription!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
