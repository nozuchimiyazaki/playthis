<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $fillable = [
        'music_id',
        'user_id',
        'guest_identification',
    ];
}
