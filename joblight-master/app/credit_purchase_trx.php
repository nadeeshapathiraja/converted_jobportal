<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class credit_purchase_trx extends Model
{
    use Notifiable;
    protected $table = “credit_purchase_trx”;

    protected $fillable = [
        'transaction_no',
        'employer_profile_id',
        'pack_name',
        'credits',
        'created_at',
        'status',

    ];
}
