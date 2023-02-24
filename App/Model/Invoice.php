<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Invoice extends Telthemweb
{
    protected $fillable = [
        'invoicenumber',
        'task_id',
        'company_id',
        'administrator_id',
        'price',
        'qty',
        'discountperc',
        'discountamount',
        'tax_perc',
        'taxamount',
        'sub_total',
        'total_amt',
        'invoice_note',
        'invoice_status',
        'invoice_due_date'
    ];

    public  function createdby()
    {
        return $this->hasOne(Administrator::class,'administrator_id','id');
    }
    public  function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public  function task()
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }

    public  function payments()
    {
        return $this->hasMany(Payment::class,'invoice_id','id');
    }

}