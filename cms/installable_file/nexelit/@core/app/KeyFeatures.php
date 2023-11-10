<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyFeatures extends Model
{
    protected $table = 'key_features';

    protected $fillable = ['title','icon','lang'];
}
