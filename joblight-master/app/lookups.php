<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class lookups extends Model
{
    use Notifiable;
    protected $table = “employerjobposts”;


    protected $fillable = [
        'lookup_type',
        'lookup_sub_type',
        'lookup_code',
        'lookup_name',
        'active_ind',
        'set_order',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',


    ];
}
