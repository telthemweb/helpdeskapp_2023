<?php

return [

    'auth' => [
        'fields'     => ['username', 'email'],
        'model'      => Ti\Helpdesk\App\Model\Administrator::class,
        'activation' => [], 
    ],
    'encryption' => [
        'key'    => 'euyq74taeoqiertpeuyq74taeoqiertp',
        'cipher' => 'AES-128-CBC',
    ],
];