<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = "billings";
    protected $fillable = ["title", "automatic_sending", "automatic_billing", "sunday_billing", "daily_billing", "monday_billing", "tuesday_billing", "wednesday_billing", "thursday_billing", "friday_billing", "saturday_billing", "shipping_time", "default_message", "server", "application_id", "device_id", "customer_referal_id", "customer_subscription_status", "days_to_expire", "shipping_interval", "last_shipment", "customer_count", "customer_received_count", "created_by"];


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

    public function get_message_template()
    {
        return $this->belongsTo(MessageTemplate::class, 'default_message', 'id');
    }
}
