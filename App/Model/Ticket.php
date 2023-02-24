<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Ticket extends Telthemweb
{
    protected $fillable =[
        'company_id',
        'ticket_number',
        'title',
        'description',
        'ticketimg',
        'ticketdocs',
        'priority',
        'expectedcompleted',
        'status'
    ];

    public  function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public  function tasks()
    {
        return $this->hasMany(Task::class,'ticket_id','id');
    }
}