<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Customers;
use App\Models\Device;
use App\Models\MessageTag;
use App\Models\MessageTemplate;
use App\Models\ProductPlan;
use App\Models\Products;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Server;
use App\Models\Subscription;
use App\Models\SubscriptionPaymentHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resellerRole = Role::where('name', 'reseller')->first();

        $resellers = RoleUser::where('role_id', $resellerRole->id)->with(['user', 'role', 'get_alert_history'])->get();


        $message_tag = MessageTag::all();
        $message_templates = MessageTemplate::all();

        return view('reseller.index', compact('resellers', 'message_templates', 'message_tag'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $reseller = User::findOrFail($id);
        return view('reseller.show', compact('reseller'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $reseller = User::findOrFail($id);
        $device = Device::all();
        $application = Application::all();
        $server = Server::all();

        return view('reseller.edit', compact('reseller', 'device', 'application', 'server'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->whatsapp = $request->whatsapp;
            $user->screen = $request->screen;
            $user->expiry_date = $request->expiry_date;
            $user->application = $request->application_id;
            $user->server = $request->get('server');
            $user->device = $request->device_id;
            $user->mac = $request->mac;
            $user->key = $request->key;
            $user->save();

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Delted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the customer subscriptions.
     */
    public function subscriptions($reseller_id)
    {
        $subscriptions = Subscription::where('reseller_id', $reseller_id)->with('reseller')->with('productplan')->get();

        $products = Products::all();
        $reseller = User::findOrFail($reseller_id);

        return view('reseller.subscription', compact('subscriptions', 'products', 'reseller'));
    }


    public function getMyCustomer($reseller_id)
    {
        $this->authorize('list', Customers::class);
        $reseller = User::findOrFail($reseller_id);
        $customers = Customers::where('created_by', $reseller_id)->with(['get_server', 'get_application', 'get_device'])->get();

        $message_tag = MessageTag::all();
        $message_templates = MessageTemplate::all();
        $page_title = $reseller->name . " Customers";

        return view('customers.index', compact('customers', 'message_tag', 'message_templates', 'page_title'));
    }



    public function subscribeReseller(Request $request, $id, $status = 1)
    {

        $validator = Validator::make($request->all(), [
            'product' => ['required', 'string', 'max:255'],
            'product_plan_id' => ['required', 'string', 'max:255'],
            'subscription_duration' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {

                $subscription = Subscription::where('product_plan_id', $request->product_plan_id)
                    ->where('reseller_id', auth()->user()->id)
                    ->where('active_status', 0)
                    ->orderBy('id', 'desc')
                    ->first();

                if ($subscription) {
                    //redirect to payment portal
                }


                $nextTime = Carbon::createFromTimestamp(
                    $this->getNextTime($request->subscription_duration)
                );

                $subscrition = new Subscription();
                $subscrition->product_plan_id = $request->product_plan_id;
                $subscrition->reseller_id = $id;
                $subscrition->next_due_date = $nextTime;
                $subscrition->subscription_duration = $request->subscription_duration;

                if ((int)$request->status === 0) {
                    $subscrition->active_status = 0;
                }

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


    public function newSubscribeReseller(Request $request, $id, $status = 1)
    {

        $validator = Validator::make($request->all(), [
            'product' => ['required', 'string', 'max:255'],
            'product_plan_id' => ['required', 'string', 'max:255'],
            'subscription_duration' => ['required', 'string', 'max:255'],
        ]);

        $now = Carbon::now();


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            try {
                $nextTime =  $now->subDay(1);

                $subscription = new Subscription();
                $subscription->product_plan_id = $request->product_plan_id;
                $subscription->reseller_id = $id;
                $subscription->next_due_date = $nextTime;
                $subscription->subscription_duration = $request->subscription_duration;

                $subscription->active_status = 1;

                $subscription->save();

                return redirect()->route('home')->with('message', 'Subscription created successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function subscribeResellerEdit(int $id)
    {
        $subscription = Subscription::with('reseller')->with('productplan')->findOrFail($id);
        $productplan = ProductPlan::where("product_id", $subscription->productplan->product->id)->with('plan')->get();

        return view('reseller.subscriptions-edit', compact('subscription', 'productplan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function subscribeResellerUpdate(Request $request, int $id)
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
    public function subscribeResellerDisable(int $id)
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


    public function subscribeResellerHistoryList($id)
    {
        $history = SubscriptionPaymentHistory::where('subscription_id', $id)->with('productplan')->with('reseller')->get();

        $subscription = Subscription::findOrFail($id);

        return view('reseller.subscription-payment-history', compact('history', 'subscription'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function subscribeResellerHistory(Request $request, $subscription_id)
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
                $subscription_history->reseller_id = $subscription->reseller_id;
                $subscription_history->next_due_date_payment = $subscription->next_due_date;
                $subscription_history->subscription_duration = $subscription->subscription_duration;
                $subscription_history->subscription_id = $subscription->id;
                $subscription_history->payment_status = 1;
                $subscription_history->payment_type = $request->payment_option;
                $newPayment = $subscription_history->save();

                //update next payment date  
                $nextDuePayment = Carbon::createFromTimestamp(
                    $this->getNextTimeOrigin($subscription->next_due_date, $subscription->subscription_duration)
                );

                $updated = $subscription->update(['next_due_date' => $nextDuePayment]);

                //update customer with next due date 
                User::find($subscription->reseller_id)->update(['expiry_date' => $nextDuePayment]);

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


    protected function getNextTimeOrigin($next_due_date, $subscription_duration)
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
}
