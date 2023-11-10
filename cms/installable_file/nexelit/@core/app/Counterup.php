<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counterup extends Model
{
    protected $table = 'counterups';
    protected $fillable = ['icon','number','title','extra_text','lang'];
}
