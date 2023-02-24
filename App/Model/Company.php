<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\Telthemweb;

class Company extends Telthemweb
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'city',
        'address',
        'googlemaplink',
        'phonenumber',
        'password',
        'email'
    ];
    
    public  function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public  function tickets()
    {
        return $this->hasMany(Ticket::class,'company_id','id');
    }

    public  function invoice()
    {
        return $this->hasOne(Invoice::class,'company_id','id');
    }
    public  function payment()
    {
        return $this->hasOne(Payment::class,'company_id','id');
    }
    public  function receipt()
    {
        return $this->hasOne(Receipt::class,'company_id','id');
    }

    public  function penalties()
    {
        return $this->hasMany(Penalty::class,'company_id','id');
    }
}