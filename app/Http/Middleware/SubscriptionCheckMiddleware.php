<?php

namespace App\Http\Middleware;

use App\Models\Plans;
use App\Models\Products;
use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;


class SubscriptionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $excludedRoutes = ['reseller.subscriptions.store', 'reseller.subscription.history', 'payment.createPayment', 'payment.callback', 'register.subscription.page'];
        if (Auth::check()) {
            if (!in_array($request->route()->getName(), $excludedRoutes) && Auth::user()->hasRole('reseller')) {

                $subscription = Subscription::where('reseller_id', Auth::user()->id)->where('active_status', 1)->orderBy('id', 'desc')->first();
                $plans = Plans::all();
                if (!$subscription) {


                    $products = Products::all();

                    $routeUrl = route('register.subscription.page', ['products' => $products]);

                    // Return a response without redirecting 
                    return response()->view('auth.subscription.newuser-subscription', compact('plans', "products")); //->header('Location', $routeUrl);
                }

                $subscriptionExpired = Subscription::where('reseller_id', Auth::user()->id)->where('active_status', 1)->orderBy('id', 'desc')->first();

                if ($subscriptionExpired && $this->hasDateTimeElapsed($subscriptionExpired->next_due_date)) {

                    $routeUrl = route('renew.subscription.page');

                    return response()->view('auth.subscription.renewuser-subscription', compact("subscription"))->header('Location', $routeUrl);
                }
            }
        }
        return $next($request);
    }

    public function hasDateTimeElapsed($dateTime)
    {
        // Convert the input DateTime to a Carbon instance
        $targetDateTime = Carbon::parse($dateTime);

        // Get the current DateTime
        $currentDateTime = Carbon::now();

        // Compare the two DateTime instances
        return $currentDateTime->gte($targetDateTime);
    }
}
