<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'whatsapp_number',
        'status',
        'website_url'
    ];
}
