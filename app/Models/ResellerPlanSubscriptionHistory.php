<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerPlanSubscriptionHistory extends Model
{
    use HasFactory;

    protected $table = 'reseller_plan_subscription_history';


    function reseller()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(User::class, 'reseller_id', 'id');
    }

    public function resellerplan()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(ResellerPlan::class, 'reseller_plan_id', 'id');
    }
}
