<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Category extends Telthemweb
{
    protected $fillable =[
        'name'
    ];


    public  function companies()
    {
        return $this->hasMany(Company::class,'category_id','id');
    }
}