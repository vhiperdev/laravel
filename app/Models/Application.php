<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = "application";

    protected $fillable = ['name'];

    public function customers()
    {
        return $this->hasMany(Customers::class, 'application_id', 'id');
    }

    public function getCustomerCount()
    {
        return $this->customers()->get()->count();
    }
}
