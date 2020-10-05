<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailTemplate extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'slug', 'subject', 'body', 'status'];
}
