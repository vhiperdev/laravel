<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReferal extends Model
{
    use HasFactory;
    protected $table = "customer_referal";
    protected $fillable = ["name", "cost_per_customer", "amount_earned"];
}
