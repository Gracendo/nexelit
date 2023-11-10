<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationLogs extends Model
{
    protected $table = 'donation_logs';
    protected $fillable = ['donation_id','email','name','status','amount','transaction_id','payment_gateway','track','user_id','anonymous'];

    public function donation(){
        return $this->belongsTo('App\Donation','donation_id');
    }
}
