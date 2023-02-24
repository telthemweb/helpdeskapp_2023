<?php

namespace Ti\Helpdesk\App\Model;
use Spatie\Permission\Traits\HasRoles;
use Ti\Helpdesk\App\System\Telthemweb;

class Employeetask extends Telthemweb{
    protected $table ="employee_task";
    protected $fillable = [
        'task_id',
        'administrator_id',
        'status',
        'mailremider',
        'remindAdminNotDone',
        'status'
    ];

    //ManyToOne
    public  function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }

    //Many to one
    public  function administrator()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

}