<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Receipt extends Telthemweb
{
    protected $fillable =[
        'payment_id',
        'company_id',
        'invoice_id',
        'receiptnumber',
        'amount',
        'accountnumber',
        'paymentmode,'
    ];

    public  function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public  function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public  function payment()
    {
        return $this->belongsTo(Payment::class,'payment_id','id');
    }
    
}