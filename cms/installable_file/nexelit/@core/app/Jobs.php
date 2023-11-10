<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'jobs';
    protected $fillable = [
        'title',
        'position',
        'company_name',
        'category_id',
        'vacancy',
        'job_responsibility',
        'employment_status',
        'education_requirement',
        'experience_requirement',
        'additional_requirement',
        'job_location',
        'salary',
        'other_benefits',
        'email',
        'deadline',
        'meta_tags',
        'meta_description',
        'status',
        'lang',
        'slug',
        'application_fee_status',
        'application_fee',
        'job_context',
        ];

    public function category(){
        return $this->hasOne('App\JobsCategory','id','category_id');
    }
}
