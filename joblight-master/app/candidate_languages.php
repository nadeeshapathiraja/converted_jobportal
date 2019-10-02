<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class candidate_languages extends Model
{
    use Notifiable;
    protected $table = “candidate_languages”;


    protected $fillable = [
        'candidate_profile_id',
        'language_code',
        'spoken_level',
        'written_level',
        'default',

    ];
}
