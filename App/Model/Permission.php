<?php

namespace Ti\Helpdesk\App\Model;

use Ti\Helpdesk\App\System\Telthemweb;

class Permission extends Telthemweb
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'role_has_permissions','permission_id','role_id');
      }
}