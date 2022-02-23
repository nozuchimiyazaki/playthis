<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    //
    /**
     * fillable
     */
    protected $fillable = [
        'name','order',
    ];
}
