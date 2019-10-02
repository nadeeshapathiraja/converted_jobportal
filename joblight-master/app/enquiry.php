<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class enquiry extends Model
{
    use Notifiable;
    protected $table = “enquiry”;


    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'city',
        'state',
        'country',
        'action_taken',
        'updated_by',
        'updated_at',


    ];
}
