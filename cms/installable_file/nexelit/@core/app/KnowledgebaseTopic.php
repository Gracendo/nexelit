<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KnowledgebaseTopic extends Model
{
    protected $table = 'knowledgebase_topics';
    protected $fillable = ['title','status','lang'];
}
