<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AdminCommission extends Model
{
    use Notifiable;

    protected $fillable = [
        'value'
    ];
}
