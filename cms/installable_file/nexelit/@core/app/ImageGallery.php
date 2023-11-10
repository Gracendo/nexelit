<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    protected $table = 'image_galleries';
    protected $fillable = ['image','title','lang','cat_id'];
}
