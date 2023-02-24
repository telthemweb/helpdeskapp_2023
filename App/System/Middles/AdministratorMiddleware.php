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
class AdministratorMiddleware{

    public function __construct()
    {
        $this->redirectIfNotAuthenticated();
    }
    public function redirectIfNotAuthenticated()
    {
        
        if($_SESSION['admin_id'] == NULL || !isset($_SESSION['admin_id']))
        {
            $session = new SessionManager;
            $session->setFlash('error', 'You are not authorized to this Page. Please Login first!!');
            Configuration::redirection('admin/login'); 
            
            
        }
    }
}
