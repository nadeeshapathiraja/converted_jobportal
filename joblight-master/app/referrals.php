<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class referrals extends Model
{
    use Notifiable;
    protected $table = “employerjobposts”;


    protected $fillable = [
        'referral_type',
        'candidate_profile_id',
        'jobpost_id',
        'candidate_email',
        'referral_email',
        'referral_status',
        'personal_msg',
        'resume_downloads',
        'expiry_date',
        'agent_referral_id',
        'resent_count',
        'created_at',
        'updated_at',


    ];
}
