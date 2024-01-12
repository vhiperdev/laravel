<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAlert extends Model
{
    use HasFactory;
    protected $table = "customer_alert";

    public function get_customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function get_message_template()
    {
        return $this->belongsTo(MessageTemplate::class, 'message_template_id', 'id');
    }
}
