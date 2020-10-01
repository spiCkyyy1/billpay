<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categories extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'slug', 'status'];
}
