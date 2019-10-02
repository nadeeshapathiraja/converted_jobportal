<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
    use Notifiable;
    protected $table = “accounts”;


    protected $fillable = [
        'account_type',
        'email',
        'password',
        'is_subscribed',
        'account_status',
        'created_by',
        'account_created_at',
        'account_created_ip',
        'encrypted_key',
        'verified_at',
        'api_token',
    ];
}
