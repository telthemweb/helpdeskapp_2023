<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Task extends Telthemweb
{
    protected $fillable =[
        'ticket_id',
        'taskcode',
        'taskcomment',
        'prioritType',
        'task_date',
        'task_end',
        'assignedby',
        'hasInvoice',
        'status'
    ];

    public  function ticket()
    {
        return $this->belongsTo(Ticket::class,'ticket_id','id');
    }

    public  function emptasks()
    {
        return $this->belongsTo(Employeetask::class,'task_id','id');
    }

    public  function invoice()
    {
        return $this->hasOne(Invoice::class,'task_id','id');
    }
    public  function penalty()
    {
        return $this->hasOne(Penalty::class,'task_id','id');
    }
}