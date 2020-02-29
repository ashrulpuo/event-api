<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    protected $table = "event_status";

    protected $fillable = [
        'user_id',
        'event_id',
        'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
