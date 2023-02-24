<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Role_has_permission extends Telthemweb
{
    public function permission()
    {
        return $this->hasOne(Permission::class,'id','permission_id');
    }
}