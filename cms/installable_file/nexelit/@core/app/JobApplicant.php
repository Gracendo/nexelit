<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    protected $table = 'job_applicants';
    protected $fillable = [
        'form_content',
        'jobs_id',
        'attachment',
        'track',
        'transaction_id',
        'name',
        'email',
        'application_fee',
        'payment_gateway',
        'payment_status',
    ];

    public function job(){
        return $this->belongsTo('App\Jobs','jobs_id');
    }
}
