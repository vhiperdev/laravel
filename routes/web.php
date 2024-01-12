<?php

use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/lang', function () {
    session(['locale' => request()->get('locale')]);
    return redirect()->back();
})->name('lang');

Route::get('/', function () {
    if (Auth()->user()) :
        return redirect('home');
    else :
        return view('auth.login');
    endif;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/registration/subscription', function () {
    $products = Products::all();
    return view('auth.subscription.newuser-subscription', compact('products'));
})->name('register.subscription.page');

Route::get('/renew/subscription', function () {
    return view('auth.subscription.renewuser-subscription');
})->name('renew.subscription.page');



/**
 * GENERAL ROUTE 
 * */

//customer
Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
Route::get('customer/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customers.show');
Route::get('customer/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customers.edit');
Route::post('customer/update/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customers.update');
Route::get('customers/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customers.create');
Route::post('customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customers.store');
Route::get('customer/destroy/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customers.destroy');
Route::get('customer/subscription/{id}', [App\Http\Controllers\CustomerController::class, 'subscriptions'])->name('customers.subscriptions');

//Billing
Route::get('billing/configure', [App\Http\Controllers\BillingController::class, 'index'])->name('billing.configure');
Route::post('billing/configure/store', [App\Http\Controllers\BillingController::class, 'store'])->name('billing.store');
Route::post('billing/update', [App\Http\Controllers\BillingController::class, 'update'])->name('billing.update');
Route::get('billing/destroy/{id}', [App\Http\Controllers\BillingController::class, 'destroy'])->name('billing.destroy');
Route::get('billing/history/{id}', [App\Http\Controllers\BillingController::class, 'getHistory'])->name('billing.history');

//alert 
Route::get('messaging/alert/send/{id}', [App\Http\Controllers\MessagingController::class, 'sendAlert'])->name('messaging.alert.send');




// Products
Route::get('products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
Route::get('product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
Route::get('product/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
Route::post('product/asign/plan/{id}', [App\Http\Controllers\ProductController::class, 'asignPlan'])->name('product.asign.plan');
Route::get('product/unasign/plan/{id}', [App\Http\Controllers\ProductController::class, 'unAsignPlan'])->name('product.unasign.plan');


// Plans
Route::get('plans', [App\Http\Controllers\PlansController::class, 'index'])->name('plans');
Route::get('plan/{id}', [App\Http\Controllers\PlansController::class, 'show'])->name('plan.show');
Route::get('plan/edit/{id}', [App\Http\Controllers\PlansController::class, 'edit'])->name('plan.edit');
Route::post('plan/update/{id}', [App\Http\Controllers\PlansController::class, 'update'])->name('plan.update');
Route::post('plan/store', [App\Http\Controllers\PlansController::class, 'store'])->name('plans.store');


//subscription
Route::post('subscription/{id}', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscriptions.store');
Route::get('subscription/history/{id}', [App\Http\Controllers\SubscriptionPaymentHistoryController::class, 'show'])->name('subscription.history');
Route::get('subscriptions', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions');
Route::get('subscriptions/active', [App\Http\Controllers\SubscriptionController::class, 'active'])->name('subscriptions.active');
Route::get('subscriptions/due_this_month', [App\Http\Controllers\SubscriptionController::class, 'due_this_month'])->name('subscriptions.due_this_month');
Route::get('subscriptions/inactive', [App\Http\Controllers\SubscriptionController::class, 'inactive'])->name('subscriptions.inactive');
Route::get('subscriptions/over_due', [App\Http\Controllers\SubscriptionController::class, 'over_due'])->name('subscriptions.over_due');

Route::get('subscriptions/edit/{id}', [App\Http\Controllers\SubscriptionController::class, 'edit'])->name('subscription.edit');
Route::post('subscriptions/update/{id}', [App\Http\Controllers\SubscriptionController::class, 'update'])->name('subscription.update');
Route::get('subscriptions/disable/{id}', [App\Http\Controllers\SubscriptionController::class, 'disable'])->name('subscription.disable');

Route::post('subscription/history/store/{id}', [App\Http\Controllers\SubscriptionPaymentHistoryController::class, 'store'])->name('subscriptions.history.store');





//messaging
Route::get('messaging/template', [App\Http\Controllers\MessageTemplateController::class, 'index'])->name('messaging.template');
Route::post('messaging/template', [App\Http\Controllers\MessageTemplateController::class, 'store'])->name('messaging.template.store');
Route::post('messaging/template/update', [App\Http\Controllers\MessageTemplateController::class, 'update'])->name('messaging.template.update');
Route::get('messaging/template/destroy/{id}', [App\Http\Controllers\MessageTemplateController::class, 'destroy'])->name('messaging.template.destroy');
Route::get('messaging/configure', [App\Http\Controllers\SubscriptionController::class, 'configure'])->name('messaging.configure');
Route::post('messaging/alert/customer', [App\Http\Controllers\MessagingController::class, 'alert'])->name('messaging.alert.customer');


Route::post('reseller/subscribe/{id}/{status}', [App\Http\Controllers\ResellerController::class, 'subscribeReseller'])->name('reseller.subscriptions.store.sub');


// admin routes or controllers 
Route::group(['middleware' => 'role:admin'], function () {

    // Plans 
    Route::get('plan/destroy/{id}', [App\Http\Controllers\PlansController::class, 'destroy'])->name('plan.destroy');




    //settings
    Route::get('settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::post('settings/update', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');

    //server
    Route::get('servers', [App\Http\Controllers\ServerController::class, 'index'])->name('servers');
    Route::post('servers/store', [App\Http\Controllers\ServerController::class, 'store'])->name('servers.store');
    Route::post('servers/update', [App\Http\Controllers\ServerController::class, 'update'])->name('server.update');
    Route::get('servers/customers/{id}', [App\Http\Controllers\ServerController::class, 'serverCustomers'])->name('server.customer');

    //applications
    Route::get('applications', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications');
    Route::post('applications/update', [App\Http\Controllers\ApplicationController::class, 'update'])->name('application.update');
    Route::post('applications/store', [App\Http\Controllers\ApplicationController::class, 'store'])->name('application.store');
    Route::get('applications/customers/{id}', [App\Http\Controllers\ApplicationController::class, 'serverCustomers'])->name('applications.customer');

    //settings
    Route::get('devices', [App\Http\Controllers\DeviceController::class, 'index'])->name('devices');
    Route::post('device/update', [App\Http\Controllers\DeviceController::class, 'update'])->name('device.update');
    Route::post('device/store', [App\Http\Controllers\DeviceController::class, 'store'])->name('device.store');
    Route::get('device/customers/{id}', [App\Http\Controllers\DeviceController::class, 'serverCustomers'])->name('device.customer');


    //customer referal platform
    Route::get('customer_referal', [App\Http\Controllers\CustomerReferalController::class, 'index'])->name('customer_referal');
    Route::post('customer_referal/store', [App\Http\Controllers\CustomerReferalController::class, 'store'])->name('customer_referal.store');
    Route::post('customer_referal/update', [App\Http\Controllers\CustomerReferalController::class, 'update'])->name('customer_referal.update');
    Route::get('customer_referal/destroy/{id}', [App\Http\Controllers\CustomerReferalController::class, 'destroy'])->name('customer_referal.destroy');
    Route::get('customer_referal/customers/{id}', [App\Http\Controllers\CustomerReferalController::class, 'serverCustomers'])->name('customer_referal.customer');


    //settings
    Route::get('settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');

    //reseller
    Route::get('reseller', [App\Http\Controllers\ResellerController::class, 'index'])->name('reseller');
    Route::get('reseller/{id}', [App\Http\Controllers\ResellerController::class, 'show'])->name('reseller.show');
    Route::get('reseller/edit/{id}', [App\Http\Controllers\ResellerController::class, 'edit'])->name('reseller.edit');
    Route::post('reseller/update/{id}', [App\Http\Controllers\ResellerController::class, 'update'])->name('reseller.update');
    Route::get('reseller/destroy/{id}', [App\Http\Controllers\ResellerController::class, 'destroy'])->name('reseller.destroy');
    Route::get('reseller/subscription/{id}', [App\Http\Controllers\ResellerController::class, 'subscriptions'])->name('reseller.subscriptions');
    Route::post('reseller/subscribe/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeReseller'])->name('reseller.subscriptions.store');
    Route::get('reseller/subscriptions/edit/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerEdit'])->name('reseller.subscription.edit');
    Route::post('reseller/subscriptions/update/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerUpdate'])->name('reseller.subscription.update');
    Route::get('reseller/subscriptions/disable/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerDisable'])->name('reseller.subscription.disable');
    Route::get('reseller/subscription/history/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerHistoryList'])->name('reseller.subscription.history.list');
    Route::post('reseller/subscription/history/store/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerHistory'])->name('reseller.subscription.history');


    Route::get('reseller/customer/{id}', [App\Http\Controllers\ResellerController::class, 'getMyCustomer'])->name('reseller.customers');

    Route::post('messaging/alert/reseller', [App\Http\Controllers\MessagingController::class, 'alertReseller'])->name('messaging.alert.reseller');
});


/**  
 * RESELLER ROUTES
 * */
Route::group(['middleware' => 'role:reseller'], function () {
    // Reseller routes or controllers
    Route::post('reseller/subscription/history/store/{id}', [App\Http\Controllers\ResellerController::class, 'subscribeResellerHistory'])->name('reseller.subscription.history');


    //payment  
    Route::post('payment/createPayment', [App\Http\Controllers\PaymentController::class, 'createPayment'])->name('payment.createPayment');
    Route::get('payment/callback/{status}', [App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
});
