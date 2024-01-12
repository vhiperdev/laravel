<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Subscription;
use App\Models\SubscriptionPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SubscriptionPaymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $subscription_id)
    {

        $validator = Validator::make($request->all(), [
            'payment_option' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            if ($request->payment_option === 'terminal') {
                return redirect()->back()->with(['error' => 'No payment gateway integration found']);
            }

            try {

                $subscription = Subscription::findOrFail($subscription_id);


                $subscription_history = new SubscriptionPaymentHistory();

                //save current payment history
                $subscription_history->product_plan_id = $subscription->product_plan_id;
                $subscription_history->customer_id = $subscription->customer_id;
                $subscription_history->next_due_date_payment = $subscription->next_due_date;
                $subscription_history->subscription_duration = $subscription->subscription_duration;
                $subscription_history->subscription_id = $subscription->id;
                $subscription_history->payment_status = 1;
                $subscription_history->payment_type = $request->payment_option;
                $newPayment = $subscription_history->save();

                //update next payment date  
                $nextDuePayment = Carbon::createFromTimestamp(
                    $this->getNextTime($subscription->next_due_date, $subscription->subscription_duration)
                );

                $updated = $subscription->update(['next_due_date' => $nextDuePayment]);

                //update customer with next due date
                Customers::find($subscription->customer_id)->update(['expiry_date' => $nextDuePayment]);

                if (!$updated) {
                    //rollback if error
                    SubscriptionPaymentHistory::find($newPayment)->delete();
                }

                return redirect()->back()->with('message', 'Subscription payment successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }


    protected function getNextTime($next_due_date, $subscription_duration)
    {
        $now = Carbon::parse($next_due_date);

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
        $history = SubscriptionPaymentHistory::where('subscription_id', $id)->with('productplan')->with('customer')->get();

        $subscription = Subscription::findOrFail($id);

        return view('subscriptions.subscription-payment-history', compact('history', 'subscription'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
