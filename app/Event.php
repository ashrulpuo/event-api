<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;

class Event extends Model
{
    protected $table = 'event_register';

    protected $fillable = [
        'event_name',
        'venue',
        'event_date',
        'event_details',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
