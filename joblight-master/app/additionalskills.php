<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class additionalskills extends Model
{
    use Notifiable;
    protected $table = “additionalskills”;



    protected $fillable = [
        'candidate_profile_id',
        'parent_id',
        'parent_table',
        'resume_id',
        'content',
        'skill_level',

    ];
}
