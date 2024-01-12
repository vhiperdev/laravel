<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Plans;
use App\Models\Products;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_customers = Customers::all()->count();
        $total_plans = Plans::all()->count();
        $total_products = Products::all()->count();
        $active_subscriptions = Subscription::where('active_status', 1)->count();
        $inactive_subscriptions = Subscription::where('active_status', 0)->count();

        $this_week = Carbon::now()->addWeek();
        $expiring_this_week = Subscription::whereDate('next_due_date', $this_week)->count();

        $resellerRole = Role::where('name', 'reseller')->first();
        $resellers = RoleUser::where('role_id', $resellerRole->id)->count();





        // Fetch all subscribers and group the count by the year
        $subscribersData = Subscription::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year')
            ->get();

        $subscriberStatus = Subscription::select('active_status', \DB::raw('COUNT(*) as count'))
            ->groupBy('active_status')
            ->get();

        return view('home', compact('total_customers', 'total_products', 'total_plans', 'active_subscriptions', 'inactive_subscriptions', 'expiring_this_week', 'resellers', 'subscribersData', 'subscriberStatus'));
    }
}
