<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Role extends Telthemweb{
    protected $fillable =[
        'name',
        'level'
    ];

    public function administrators()
    {
        return $this->hasMany(Administrator::class,'role_Id','id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_has_permissions','role_id','permission_id');
    }
}