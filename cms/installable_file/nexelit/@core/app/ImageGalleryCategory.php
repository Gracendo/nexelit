<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageGalleryCategory extends Model
{
    protected $table = 'image_gallery_categories';
    protected $fillable = ['title','status','lang'];
}
