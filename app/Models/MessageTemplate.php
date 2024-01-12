<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;
    protected $table = "message_template";

    protected $fillable = [
        'title',
        'content',
        'vcard_name',
        'vcard_number',
        'image_attachment_url',
        'audio_attachment_url',
        'video_attachment_url',
        'created_by'
    ];
}
