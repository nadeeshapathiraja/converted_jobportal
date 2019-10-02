<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class employer_resume_downloads extends Model
{
    use Notifiable;
    protected $table = “employer_resume_downloads”;


    protected $fillable = [

        'employer_profile_id',
        'candidate_profile_id',
        'download_source',
        'credits_used',
        'job_post_id',
        'emailed_addresses',
        'status',
        'expiry_date',
        'created_at',

    ];
}
