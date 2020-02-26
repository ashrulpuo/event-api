<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event_register';

    protected $fillable = [
        'event_name',
        'venue',
        'event_date',
        'event_details'
    ];
}
