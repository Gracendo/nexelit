<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $table = 'donations';
    protected $fillable = ['title','donation_content','amount','raised','status','lang','slug','image','meta_tags','meta_description'];
}
