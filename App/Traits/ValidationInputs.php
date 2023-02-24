<?php

namespace Ti\Helpdesk\App\Traits;

trait ValidationInputs
{
   public function  validateIfInputempty($input) :bool{
       if(!empty($_POST[$input])){
           return true;
       }else{
           return false;
       }
   }

   






   
}