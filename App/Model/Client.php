<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\DataModel;

class Client extends DataModel
{
    
    public $table = "companies";


    public $id;
    public $category_id;
    public $code;
    public $name;
    public $city;
    public $googlemaplink;
    public $email;
    public $address;
    public $phonenumber;

    public $fields = [
        'category_id',
        'code',
        'name',
        'city',
        'googlemaplink',
        'email',
        'address',
        'phonenumber',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    
}