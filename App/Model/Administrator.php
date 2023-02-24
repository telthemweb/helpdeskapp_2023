<?php

namespace Ti\Helpdesk\App\Model;
use Spatie\Permission\Traits\HasRoles;
use Ti\Helpdesk\App\System\Telthemweb;

class Administrator extends Telthemweb
{
    use HasRoles;
    protected $fillable = [
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

    public  function role()
    {
        return $this->belongsTo(Role::class,'role_Id','id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'administrator_id','id');
    }

   

    public  function tasks()
    {
        return $this->hasMany(Employeetask::class,'administrator_id','id');
    }

    public function logs()
    {
        return $this->hasMany(Systemlogs::class,'administrator_id','id');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class,'administrator_id','id');
    }
}