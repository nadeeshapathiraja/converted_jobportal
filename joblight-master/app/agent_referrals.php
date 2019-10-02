<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class agent_referrals extends Model
{
    use Notifiable;
    protected $table = “agentprofiles”;


    protected $fillable = [
        'account_id',
        'agent_email',
        'document_name',
        'created_at',

    ];
}
