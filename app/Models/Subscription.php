<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ["next_due_date", "active_status"];

    function customer()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    function reseller()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(User::class, 'reseller_id', 'id');
    }


    public function productplan()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(ProductPlan::class, 'product_plan_id', 'id');
    }

    public function subscriptionPaymentHistory()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(SubscriptionPaymentHistory::class, 'subscription_id', 'id');
    }
}
