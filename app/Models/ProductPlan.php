<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPlan extends Model
{
    use HasFactory;

    protected $table = 'product_plan';

    public function plan()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(Plans::class, 'plan_id', 'id');
    }

    public function product()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
