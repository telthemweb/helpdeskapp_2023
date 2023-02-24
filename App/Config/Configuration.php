<?php
namespace Ti\Helpdesk\App\Config;
define('ROOT', 'http://localhost:9001/public');
class Configuration
{
     
    public static function redirection($path){
       return header("Location: " ."/".$path);
    }

    /**
     *  Send to current url
     * @return never
     *
     * 
     */
    
}