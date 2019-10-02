<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class agentprofiles extends Model
{
    use Notifiable;
    protected $table = “agentprofiles”;


    protected $fillable = [
        'account_id',
        'firstname',
        'lastname',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zip',
        'ic_no',
        'gender',
        'race',
        'date_of_birth',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
