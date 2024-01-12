<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingNoticeHistories extends Model
{
    use HasFactory;
    protected $table = "billing_notice_histories";
    protected $fillable = ['customer_id', 'billing_id', 'notice_delivery_status'];


    public function get_bill()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function get_customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
