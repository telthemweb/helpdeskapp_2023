<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Payment extends Telthemweb
{
    protected $fillable =[
        'paymentnumber',
        'invoice_id',
        'company_id',
        'invoice_amount',
        'amount_paid',
        'amount_left',
        'paymentmode',
    ];
    public  function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
    public  function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public  function receipt()
    {
        return $this->hasOne(Receipt::class,'payment_id','id');
    }
}