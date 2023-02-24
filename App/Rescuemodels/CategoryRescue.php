<?php

namespace Ti\Helpdesk\App\Rescuemodels;


use Ti\Helpdesk\App\System\DataModel;

//this will allow me to run away from eloquent model which refusing some of my queries

class CategoryRescue extends DataModel
{
    public $table = "categories";
    protected $fillable =[
        'name'
    ];


    public  function companies()
    {
        return $this->hasMany(new CompanyRescue,'company_id');
    }
}