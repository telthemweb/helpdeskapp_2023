<?php
/*
|--------------------------------------------------------------------------
|            This file is part of the Telthemweb package.
|               
|--------------------------------------------------------------------------
|
|     For the full copyright and license information, please view the LICENSE
|       file that was distributed with this source code.
|
*/
namespace Ti\Helpdesk\App\System\Middles;
use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\http\controllers\SessionManager;
class AuthClientMiddleware
{
    
    public function __construct()
    {
        $this->AuthenticatedUserIdData();
    }
    public function AuthenticatedUserIdData()
    {
        
        if(isset($_SESSION['user_id']))
        { 
            $session = new SessionManager;
             Configuration::redirection('company');
            //$this->back();
        }
    }

    public function back()
    {
        header('location:'.$_SERVER['HTTP_REFERER']);
        exit();
    }
}
