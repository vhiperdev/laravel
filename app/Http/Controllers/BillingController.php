<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Billing;
use App\Models\BillingNoticeHistories;
use App\Models\CustomerReferal;
use App\Models\Device;
use App\Models\MessageTemplate;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('list', Billing::class);
        $billings = Billing::where('created_by', Auth::Id())->get();
        $message_templates = MessageTemplate::all();
        $servers = Server::all();
        $applications = Application::all();
        $devices = Device::all();
        $customer_referal = CustomerReferal::all();

        return view('billings.index', compact('billings', 'message_templates', 'servers', 'applications', 'devices', 'customer_referal'));
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
        $this->authorize('store', Billing::class);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'automatic_sending' => ['nullable', 'string', 'max:255'],
            'automatic_billing' => ['nullable', 'string', 'max:255'],
            'shipping_time' => ['string', 'max:255'],
            'default_message' => ['string', 'max:255'],
            'server' => ['string', 'max:255'],
            'application_id' => ['string', 'max:255'],
            'device_id' => ['string', 'max:255'],
            'customer_referal_id' => ['string', 'max:255'],
            'customer_subscription_status' => ['string', 'max:255'],
            'days_to_expire' => ['string', 'max:255'],
            'shipping_interval' => ['string', 'max:255'],
            'last_shipment' => ['string', 'max:255'],
            'customer_count' => ['string', 'max:255'],
            'customer_received_count' => ['string', 'max:255'],
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {
                $requestData = $request->except('_token');
                $requestData['created_by'] = Auth::Id();
                Billing::create($requestData);

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
            // Get the existing record
            $billing = Billing::findOrFail($request->id);

            $requestData = array_merge([
                'automatic_billing' => 0,
                'sunday_billing' => 0,
                'daily_billing' => 0,
                'monday_billing' => 0,
                'tuesday_billing' => 0,
                'wednesday_billing' => 0,
                'thursday_billing' => 0,
                'friday_billing' => 0,
                'saturday_billing' => 0,
                'tuesday_billing' => 0,
                'created_by' => Auth::Id(),
            ], $request->except('_token', 'id'));

            // Update the model with the modified data
            $billing->update($requestData);

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Billing::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function updateSendingMethod(int $id, int $value)
    {
        try {
            Billing::with(['get_server', 'get_application', 'get_device', 'get_message_template'])->findOrFail($id)->update(['automatic_sending' => $value]);

            return response()->json("Updated succesfully", 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 403);
        }
    }

    public function getHistory($id)
    {

        $histories = BillingNoticeHistories::where('billing_id', $id)->with(['get_bill', 'get_customer'])->get();
        return view('billings.history', compact('histories'));
    }
}
