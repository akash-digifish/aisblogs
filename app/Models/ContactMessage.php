<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country_code',
        'country_name',
        'mobile',
        'company',
        'message',
        'accepted_policy',
    ];
}
