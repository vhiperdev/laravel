<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Billing;
use App\Models\Customers;
use App\Models\MessageTemplate;
use App\Models\Plans;
use App\Models\Products;
use App\Models\User;
use App\Policies\BillingPolicy;
use App\Policies\UserPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\MessageTemplatePolicy;
use App\Policies\PlansPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Customers::class => CustomerPolicy::class,
        Plans::class => PlansPolicy::class,
        Products::class => ProductPolicy::class,
        MessageTemplate::class => MessageTemplatePolicy::class,
        Billing::class => BillingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
