<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class candidateworkexps extends Model
{
    use Notifiable;
    protected $table = “candidateworkexps”;


    protected $fillable = [
        'candidate_profile_id',
        'employername',
        'industry',
        'city',
        'country',
        'state',
        'position',
        'start_date',
        'end_date',
        'still_working',
        'salary',

    ];
}
