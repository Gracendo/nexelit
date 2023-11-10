<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentLang extends Model
{
    protected $table = 'appointment_langs';
    protected $fillable = [
        'description',
        'additional_info',
        'experience_info',
        'specialized_info',
        'location',
        'meta_description',
        'meta_title',
        'meta_tags',
        'slug',
        'short_description',
        'lang',
        'appointment_id',
        'title',
        'designation',
    ];

    public function setAdditionalInfoAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['additional_info'] = serialize($final_value);
    }
    public function setExperienceInfoAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['experience_info'] = serialize($final_value);
    }
    public function setSpecializedInfoAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['specialized_info'] = serialize($final_value);
    }

    public function getAdditionalInfoAttribute($value){
        $val = unserialize($value,['class' => false]) ?? [];
        return $val;
    }
    public function getExperienceInfoAttribute($value){
        $val = unserialize($value,['class' => false]) ?? [];
        return $val;
    }
    public function getSpecializedInfoAttribute($value){
        $val = unserialize($value,['class' => false]) ?? [];
        return $val;
    }

}
