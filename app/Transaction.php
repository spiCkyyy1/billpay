<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use Notifiable;

    protected $fillable = ['user_id', 'user_email', 'payment_id', 'payment_status', 'payer_id', 'payer_email', 'payer_name', 'payer_country_code',
        'transaction_amount', 'transaction_currency', 'transaction_description', 'merchant_id', 'merchant_email',
        'commission', 'transaction_create_time', 'transaction_update_time'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
