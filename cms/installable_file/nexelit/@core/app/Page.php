<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    protected $fillable = ['title','lang','slug','meta_description','meta_tags','content','status','visibility','page_builder_status','breadcrumb_status'];
}
