<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $table = 'support_tickets';
    protected $fillable = ['title','via','operating_system','user_agent','description','subject','status','priority','user_id','admin_id','departments'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
    public function department(){
        return $this->belongsTo(SupportDepartment::class,'departments','id');
    }
}
