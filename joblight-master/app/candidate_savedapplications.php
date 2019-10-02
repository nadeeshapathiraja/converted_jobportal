<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidate_savedapplications extends Model
{
    use Notifiable;
    protected $table = “candidate_savedapplications”;


    protected $fillable = [
        'candidate_profile_id',
        'jobpost_id',
        'created_at',

    ];
}
