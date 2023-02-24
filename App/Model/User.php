<?php

namespace Ti\Helpdesk\App\Model;
use Ti\Helpdesk\App\System\DataModel;

class User extends DataModel
{
    
    public $table = "administrators";

    public $id;
    public $role_Id;
    public $name;
    public $surname;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $gender;
    public $country;
    public $province;
    public $city;
    public $address;
    public $maxtask;
    public $isOut;

    public $fields = [
        'role_Id',
        'name',
        'surname',
        'username',
        'password',
        'email',
        'phone',
        'gender',
        'country',
        'province',
        'city',
        'address',
        'maxtask',
        'isOut'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(new Role,'role_Id');
    }
    
}