<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Systemlogs extends Telthemweb
{
    protected $fillable =[
        'administrator_id',
        'timein',
        'ipaddress',
        'geolocationap',
        'useaccountname',
        'timeout',
    ];


    public  function admin()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }
}