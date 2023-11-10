<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactInfoItem extends Model
{
    protected $table = 'contact_info_items';
    protected $fillable = [ 'title','icon','lang','description'];
}
