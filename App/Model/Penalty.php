<?php
namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;
class Penalty extends Telthemweb{
    protected $fillable =[
        'task_id',
        'company_id',
        'rate',
        'numb_hours',
        'comment',
        'status',
        'administrator_id',
    ];
    public  function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }

    public  function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
}