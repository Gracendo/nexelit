<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentCategoryLang extends Model
{
    protected $table = 'appointment_category_langs';
    protected $fillable = ['cat_id','title','lang'];
}
