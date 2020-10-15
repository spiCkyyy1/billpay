<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use Notifiable;

    protected $fillable = ['category_id','name', 'country', 'state', 'city', 'address', 'zip_code', 'email', 'password', 'paypal_id', 'status'];

    public function category(){
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
}
