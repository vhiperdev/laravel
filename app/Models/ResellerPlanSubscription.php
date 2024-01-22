<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerPlanSubscription extends Model
{
    use HasFactory;

    protected $table = 'reseller_plan_subscription';
    protected $fillable = ['next_due_date'];



    function reseller()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(User::class, 'reseller_id', 'id');
    }


    public function resellerPlan()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(ResellerPlan::class, 'reseller_plan_id', 'id');
    }

    public function resellerPlanSubscriptionHistory()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(ResellerPlanSubscriptionHistory::class, 'reseller_plan_sub_id', 'id');
    }
}
