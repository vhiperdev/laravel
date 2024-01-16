<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappSession extends Model
{
    use HasFactory;

    protected $table = "whatsapp_session";

    protected $fillable = ['scanned_status'];

    function user()
    {
        // Assuming a one-to-one or many-to-one relationship
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
