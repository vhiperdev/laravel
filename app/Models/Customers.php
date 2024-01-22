<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = ['expiry_date', 'password'];

    public function get_application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }


    public function get_device()
    {
        return $this->belongsTo(Device::class, 'device_id', 'id');
    }


    public function get_server()
    {
        return $this->belongsTo(Server::class, 'server', 'id');
    }


    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function get_alert_history()
    {
        return $this->hasMany(CustomerAlert::class, 'customer_id', 'id');
    }

    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'customer_id', 'id');
    }


    public function subscriptionPaymentHistory()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->hasMany(SubscriptionPaymentHistory::class, 'customer_id', 'id');
    }
}
