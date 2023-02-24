<?php

namespace Ti\Helpdesk\App\Traits;

use Ti\Helpdesk\App\Model\Permission;

trait Permissiondata{

    public function  hasPermission($permision) :bool {
        $permision = Permission::where('name',$permision)->first();
        $hasPerm=false;
        if($permision->roles !=null){
            foreach ($permision->roles as $r){
                if($r->id == $_SESSION['role_Id'])
                {
                    $hasPerm = true;
                }
                else{
                    $hasPerm = false;
                }      
            }
        }
        return $hasPerm;
    }

}