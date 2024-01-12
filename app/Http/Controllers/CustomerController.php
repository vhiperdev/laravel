<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Customers;
use App\Models\Device;
use App\Models\MessageTag;
use App\Models\MessageTemplate;
use App\Models\Products;
use App\Models\Server;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $customers = Customers::with(['get_server', 'get_application', 'get_device', 'get_alert_history']);

        // Check if the user has the 'admin' role
        if (Auth()->user()->hasRole('admin')) {
            $customers = $customers->get();
        } else {
            // For non-admin users, only fetch their own customers
            $customers = $customers->where('created_by', Auth()->id())->get();
        }

        $message_tag = MessageTag::all();
        $message_templates = MessageTemplate::all();
        $page_title = "All Customers";

        return view('customers.index', compact('customers', 'message_tag', 'message_templates', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Customers::class);

        $device = Device::all();
        $application = Application::all();
        $server = Server::all();

        return view('customers.create', compact('device', 'application', 'server'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('store', Customers::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'whatsapp' => ['required', 'string', 'max:255'],
            'screen' => ['string', 'max:255'],
            'device_id' => ['string', 'max:255'],
            'expiry_date' => ['string', 'max:255'],
            'application_id' => ['string', 'max:255'],
            'server' => ['string', 'max:255'],
            'mac' => ['string', 'max:255'],
            'key' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors(['error' => $validator->errors()->first()]);
        } else {
            try {
                $customer = new Customers();

                $customer->name = $request->name;
                $customer->username = $request->username;
                $customer->whatsapp = $request->whatsapp;
                $customer->screen = $request->screen;
                $customer->expiry_date = $request->expiry_date;
                $customer->device_id = $request->device_id;
                $customer->application_id = $request->application_id;
                $customer->server = $request->get('server');
                $customer->mac = $request->mac;
                $customer->key = $request->key;
                $customer->created_by = auth()->user()->id;
                // dd($customer);
                $customer->save();

                return redirect()->back()->with('message', 'Created successfully');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('view', Customers::class);

        $customer  = Customers::with(['get_server', 'get_application', 'get_device'])->findOrFail($id);
        // If the execution reaches here, it means the user is authorized
        // Perform actions specific to showing the customer

        return view('customers.show', compact('customer'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customers $customers, $id)
    {
        $this->authorize('edit', $customers);

        $customer  = Customers::with(['get_server', 'get_application', 'get_device'])->findOrFail($id);

        $device = Device::all();
        $application = Application::all();
        $server = Server::all();

        return view('customers.edit', compact('customer', 'device', 'application', 'server'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->authorize('update', new Customers());

        try {
            $customer = Customers::findOrFail($id);
            $customer->name = $request->name;
            $customer->username = $request->username;
            $customer->whatsapp = $request->whatsapp;
            $customer->screen = $request->screen;
            $customer->expiry_date = $request->expiry_date;
            $customer->application_id = $request->application_id;
            $customer->server = $request->get('server');
            $customer->device_id = $request->device_id;
            $customer->mac = $request->mac;
            $customer->key = $request->key;
            $customer->created_by = auth()->user()->id;
            $customer->save();

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
        $this->authorize('destroy', new Customers());
        try {
            Customers::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the customer subscriptions.
     */
    public function subscriptions($customer_id)
    {
        $this->authorize('customer_subscription_list', new Customers());

        $subscriptions = Subscription::where('customer_id', $customer_id)->with('customer')->with('productplan')->get();

        $products = Products::all();
        $customer = Customers::findOrFail($customer_id);

        return view('customers.subscription', compact('subscriptions', 'products', 'customer'));
    }
}
