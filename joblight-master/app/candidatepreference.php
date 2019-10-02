<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidatepreference extends Model
{
    use Notifiable;
    protected $table = “candidatepreference”;

    protected $fillable = [
        'account_id',
        'specialization',
        'location_country',
        'location_state',
        'salary_currency',
        'salary_amount',

    ];
}
