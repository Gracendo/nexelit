<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';
    protected $fillable = ['name','lang','description','designation','image','icon_one','icon_two','icon_three','icon_one_url','icon_two_url','icon_three_url'];
}
