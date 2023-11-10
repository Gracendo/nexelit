<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialIcons extends Model
{
    protected $table = 'social_icons';
    protected $fillable = ['icon','url'];
}
