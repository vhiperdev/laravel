<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPaymentHistory extends Model
{
    use HasFactory;

    protected $table = "subsription_payment_history";

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
}
