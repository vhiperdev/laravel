<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPaymentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WandesCardoso\MercadoPago\Facades\MercadoPago;
use WandesCardoso\MercadoPago\DTO\Item;
use WandesCardoso\MercadoPago\DTO\BackUrls;
use WandesCardoso\MercadoPago\DTO\Payer;
use WandesCardoso\MercadoPago\DTO\Preference;



class PaymentController extends Controller
{
    public function createPayment()
    {
        try {
            $user = Auth::user();

            $subscribers = Subscription::where('reseller_id', $user->id)->with('productplan')->first();

            $plan = $subscribers->productplan->plan;
            $logo = asset('/dist/img/AdminLTELogo.png');

            $payer = new Payer(
                $user->email
            );

            $value = $this->calculateAmount($plan->value, $subscribers->subscription_duration);

            $item = Item::make()
                ->setTitle($plan->name)
                ->setQuantity(1)
                ->setUnitPrice($value)
                ->setDescription("Subscription plan")
                ->setPictureUrl($logo)
                ->setCategoryId($plan->id);

            $preference = Preference::make()
                ->setPayer($payer)
                ->addItem($item)
                ->setBackUrls(new BackUrls(
                    route('payment.callback', ['status' => 'success']),
                    route('payment.callback', ['status' => 'pending']),
                    route('payment.callback', ['status' => 'failure'])
                ))
                ->setExternalReference('20');

            $response = MercadoPago::preference()->create($preference);

            return redirect($response['body']->init_point);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' =>  $e->getMessage()]);
        }
    }

    protected function calculateAmount($amount, $duraton)
    {
        switch ($duraton) {
            case 'monthly':
                return $amount;
            case 'quarterly':
                return $amount * 6;
            case 'anually':
                return $amount * 12;
        }
    }


    public function callback(Request $request)
    {
        // dd($request->all()['preference_id']);
        // dd($request->all());
        $user = Auth::user();
        $preference_id = $request->all()['preference_id'];
        $collection_status = $request->all()['collection_status'];

        if ($collection_status == "success") {
            try {
                $subscription = Subscription::where('reseller_id', Auth::user()->id)->orderBy('id', 'desc')->first();
                $currentDateTime = Carbon::now();
                $subscription->update(['active_status' => 1, 'next_due_date' => $currentDateTime]);


                $subscription_history = new SubscriptionPaymentHistory();

                //save current payment history
                $subscription_history->product_plan_id = $subscription->product_plan_id;
                $subscription_history->reseller_id = $subscription->reseller_id;
                $subscription_history->next_due_date_payment = $subscription->next_due_date;
                $subscription_history->subscription_duration = $subscription->subscription_duration;
                $subscription_history->subscription_id = $subscription->id;
                $subscription_history->payment_status = 1;
                $subscription_history->payment_type = 'terminal';
                $subscription_history->payment_reference = $preference_id;
                $subscription_history->payment_gateway = 'Mercadopago';
                $subscription_history->save();

                return redirect('home')->with(['success' => "Your subscription has been renewed successfully"]);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' =>  $e->getMessage()]);
            }
        } else {
            return redirect()->back()->with(['error' => "Your payment was not processed"]);
        }
    }
}
