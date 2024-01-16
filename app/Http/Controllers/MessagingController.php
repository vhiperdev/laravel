<?php

namespace App\Http\Controllers;

use App\Jobs\ManualWhatsappNotification;
use App\Models\Billing;
use App\Models\CustomerAlert;
use App\Models\Customers;
use App\Models\MessageTemplate;
use App\Models\User;
use App\Services\SendMessages;
use App\Traits\TextReplacementTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessagingController extends Controller
{
    use TextReplacementTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    /**
     * Display a listing of the resource.
     */
    public function alert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:255'],
            'customer_id' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            $data = $request->all();

            $customer = Customers::findOrFail($request->customer_id);
            if (!empty($request->message) && $request->message != '' && $request->message != '--select Message--') {

                $message_template = MessageTemplate::findOrFail($request->message);
                $processedText = $this->replacePlaceholders($customer, $message_template->content);
                $data['message'] = $processedText;
                $data['title'] =  $message_template->title;
            } elseif (!empty($request->content)) {

                $processedText = $this->replacePlaceholders($customer, $request->content);
                $data['message'] = $processedText;
            }

            try {

                $sender_id = Auth::user()->id;

                $send = new SendMessages();
                $send->send($customer->whatsapp, $data['message'], $sender_id);

                //save alert
                $customer_alert = new CustomerAlert();
                $customer_alert->customer_id = $request->customer_id;
                $customer_alert->message_template_id = $request->message;
                $customer_alert->message_content =  $processedText;
                $customer_alert->save();

                return redirect()->back()->with(['message' => "Alert sent"]);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }




    public function alertReseller(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:255'],
            'reseller_id' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->first()]);
        } else {

            $data = $request->all();

            $customer = User::findOrFail($request->reseller_id);
            if (!empty($request->message) && $request->message != '' && $request->message != '--select Message--') {

                $message_template = MessageTemplate::findOrFail($request->message);
                $processedText = $this->replacePlaceholders($customer, $message_template->content);
                $data['message'] = $processedText;
                $data['title'] =  $message_template->title;
            } elseif (!empty($request->content)) {

                $processedText = $this->replacePlaceholders($customer, $request->content);
                $data['message'] = $processedText;
            }

            try {

                $sender_id = Auth::user()->id;
                $send = new SendMessages();
                $send->send($customer->whatsapp, $data['message'],  $sender_id);

                //save alert
                $customer_alert = new CustomerAlert();
                $customer_alert->reseller_id = $request->reseller_id;
                $customer_alert->message_template_id = $request->message;
                $customer_alert->message_content =  $processedText;
                $customer_alert->save();

                return redirect()->back()->with(['message' => "Alert sent"]);
            } catch (\Exception $e) {

                // message delivery failure
                $customer_alert = new CustomerAlert();
                $customer_alert->reseller_id = $request->reseller_id;
                $customer_alert->message_template_id = $request->message;
                $customer_alert->message_content =  $processedText;
                $customer_alert->delivery_status = 0;
                $customer_alert->save();

                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }


    /**
     * Send alert to group.
     */

    public function sendAlert(string $id)
    {
        try {
            $bill = Billing::findOrFail($id);

            //dispatch message to queue
            dispatch(new ManualWhatsappNotification($bill));

            return redirect()->back()->with(['message' => "Message sent successfully"]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
