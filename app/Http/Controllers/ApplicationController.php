<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\Application;
use App\Models\Customers;
use App\Models\MessageTag;
use App\Models\MessageTemplate;
use App\Models\Server;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with('customers')->get();
        return view('settings.applications', compact('applications'));
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {
            try {
                $plan = new Application();

                $plan->name = $request->name;
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
            Application::findOrFail($request->id)->update(['name' => $request->name]);

            return redirect()->back()->with('message', 'Updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function serverCustomers(int $id)
    {
        $this->authorize('list', Customers::class);
        $customers = Customers::where('application_id', $id)->with(['get_server', 'get_application', 'get_device'])->get();

        $message_tag = MessageTag::all();
        $message_templates = MessageTemplate::all();
        $page_title = "Application Customers";

        return view('customers.index', compact('customers', 'message_tag', 'message_templates', 'page_title'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
