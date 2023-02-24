<?php

namespace Ti\Helpdesk\App\Rescuemodels;

use Ti\Helpdesk\App\System\DataModel;

class CompanyRescue extends DataModel
{
    public $table = "companies";

    public $id;
    public $category_id;
    public $code;
    public $name;
    public $city;
    public $address;
    public $googlemaplink;
    public $phonenumber;
    public $password;
    public $email;



    public $fields = [
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

    public function category()
    {
        return $this->hasOne(new CategoryRescue,'category_id');
    }
}