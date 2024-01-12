<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $table = "servers";
    protected $fillable = ['name'];

    public function customers()
    {
        return $this->hasMany(Customers::class, 'server', 'id');
    }

    public function getCustomerCount()
    {
        return $this->customers()->get()->count();
    }
}
