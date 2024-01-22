<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['currency', 'default_payment_message', 'mp_Access_token'];

    public function message_template()
    {
        return $this->BelongsTo(MessageTemplate::class, 'default_payment_message', 'id');
    }

    public function currencyDetails()
    {
        return $this->BelongsTo(Currency::class, 'currency', 'id');
    }
}
