<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'country', 'state', 'city', 'address', 'zip_code', 'email', 'password', 'paypal_id', 'status'];
}
