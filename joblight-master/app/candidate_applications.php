<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class candidate_applications extends Model
{
    use Notifiable;
    protected $table = “candidate_applications”;


    protected $fillable = [

        'candidate_profile_id',
        'degree',
        'school_type',
        'school_name',
        'city',
        'country',
        'state',
        'enrolldate',
        'still_studying',
        'grad_date',
        'exp_graddate',
        'is_graduated',
        'lastenrollyear',
        'future_study',
        'field_of_study',
    ];
}
