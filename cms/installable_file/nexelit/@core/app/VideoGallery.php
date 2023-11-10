<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $table = 'video_galleries';
    protected $fillable = ['title','embed_code','status'];
}
