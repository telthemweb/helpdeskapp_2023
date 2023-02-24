<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\System\Request;

class ErrorController extends Controller{
   public function getErrorPage()
   {
        $this->view("error/error", "erheader", "erfooter", []);
        //$this->view("administrator/roles/index", "dash", 'adminfooter', ['roles' => $roles,]);
   }
}