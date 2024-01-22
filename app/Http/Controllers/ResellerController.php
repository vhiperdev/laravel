<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Customers;
use App\Models\Device;
use App\Models\MessageTag;
use App\Models\MessageTemplate;
use App\Models\ProductPlan;
use App\Models\Products;
use App\Models\ResellerPlan;
use App\Models\ResellerPlanSubscription;
use App\Models\ResellerPlanSubscriptionHistory;
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

        if ($resellerRole) {
            $resellers = RoleUser::where('role_id', $resellerRole->id)->with(['user.subscription', 'role', 'get_alert_history'])->get();

            $today = now();

            $resellers->each(function ($reseller) use ($today) {
                $reseller->isActive = $reseller->user->subscription()->where(function ($query) use ($today) {
                    $query->where('next_due_date', '<=', $today)->orWhere('active_status', 0);
                })->orderBy('id', 'desc')->first() ? 0 : 1;
            });

            $message_tag = MessageTag::all();
            $message_templates = MessageTemplate::all();

            return view('reseller.index', compact('resellers', 'message_templates', 'message_tag'));
        }
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
            $user = User::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the customer subscriptions.
     */
    public function subscriptions($reseller_id)
    {
        $subscriptions = ResellerPlanSubscription::where('reseller_id', $reseller_id)->with('reseller')->with('resellerPlan')->get();

        $reseller = User::findOrFail($reseller_id);
        $resellerPlan = ResellerPlan::all();

        return view('reseller.subscription', compact('subscriptions', 'resellerPlan', 'reseller'));
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
            'plan' => ['required', 'string', 'max:255'],
            'subscription_duration' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {

                $subscription = ResellerPlanSubscription::where('reseller_plan_id', $request->plan)
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

                $subscrition = new ResellerPlanSubscription();
                $subscrition->reseller_plan_id = $request->plan;
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
            'plan_id' => ['required', 'string', 'max:255'],
            'subscription_duration' => ['required', 'string', 'max:255'],
        ]);

        $now = Carbon::now();


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            try {
                $nextTime =  $now->subDay(1);

                $subscription = new ResellerPlanSubscription();
                $subscription->reseller_plan_id = $request->plan_id;
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
        $subscription = ResellerPlanSubscription::with('reseller')->with('resellerPlan')->findOrFail($id);
        $resellerplan = ResellerPlan::all();
        // $resellerplan = ResellerPlan::findOrFail($subscription->reseller_plan_id);

        return view('reseller.subscriptions-edit', compact('subscription', 'resellerplan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function subscribeResellerUpdate(Request $request, int $id)
    {

        $this->authorize('update', new Subscription());

        try {
            $subscription = ResellerPlanSubscription::findOrFail($id);

            $subscription->subscription_duration = $request->subscription_duration;
            $subscription->reseller_plan_id = $request->plan_id;
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
        $histories = ResellerPlanSubscriptionHistory::where('reseller_plan_sub_id', $id)->with('resellerplan')->with('reseller')->get();

        $subscription = ResellerPlanSubscription::findOrFail($id);

        return view('reseller.subscription-payment-history', compact('histories', 'subscription'));
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

                $subscription = ResellerPlanSubscription::findOrFail($subscription_id);


                $subscription_history = new ResellerPlanSubscriptionHistory();

                //save current payment history
                $subscription_history->reseller_plan_id = $subscription->reseller_plan_id;
                $subscription_history->reseller_id = $subscription->reseller_id;
                $subscription_history->next_due_date = $subscription->next_due_date;
                $subscription_history->subscription_duration = $subscription->subscription_duration;
                $subscription_history->reseller_plan_sub_id = $subscription->id;
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
                    ResellerPlanSubscription::find($newPayment)->delete();
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


    public function activateDeactivate(int $id, string $status)
    {
        // dd($id, $status);

        $subscription = ResellerPlanSubscription::where('reseller_id', $id)->orderBy('id', 'DESC')->first();
        if ($status === 'activate') {
            if ($subscription) {

                $subscription_history = new ResellerPlanSubscriptionHistory();

                //save current payment history
                $subscription_history->reseller_plan_id = $subscription->reseller_plan_id;
                $subscription_history->reseller_id = $subscription->reseller_id;
                $subscription_history->next_due_date = $subscription->next_due_date;
                $subscription_history->subscription_duration = $subscription->subscription_duration;
                $subscription_history->reseller_plan_sub_id = $subscription->id;
                $subscription_history->payment_status = 1;
                $subscription_history->payment_type = 'activated_by_admin';
                $newPayment = $subscription_history->save();

                $nextDuePayment = Carbon::createFromTimestamp(
                    $this->getNextTimeOrigin($subscription->next_due_date, $subscription->subscription_duration)
                );

                $updated = $subscription->update(['next_due_date' => $nextDuePayment, 'active_status' => 1]);

                return redirect()->back()->with('message', 'Account activated successfully!');
            } else {
                return redirect()->back()->with('error', 'No subscription entry found!');
            }
        } else {
            if ($subscription) {

                $subscription->update(['active_status' => 0]);

                return redirect()->back()->with('message', 'Account deactivated successfully!');
            } else {
                return redirect()->back()->with('error', 'No subscription entry found!');
            }
        }
    }
}
