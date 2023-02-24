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
namespace Ti\Helpdesk\App\System;

class View
{
    public function __construct()
    {
        require_once __DIR__ . './../Config/section.php';
        require_once __DIR__.'./../Utils/url.php';
        require_once __DIR__.'/../Utils/templete.php';
        require_once __DIR__.'/../Utils/routeurl.php';
        $this->crsftokenGenerator();

    }


    public function responseValues($values)
    {
        if($values != NULL)
            foreach($values as $responseName => $responseValue)
                $$responseName = $responseValue;
    }

    public function getViewResponse($view,$layoutlb,$footerlayout, array $values)
    {
        if($values != NULL)
            foreach($values as $responseName => $responseValue)
                $$responseName = $responseValue;


            $this->setView($view);
             include  __DIR__ .'./../../resources/views/layouts/'.$layoutlb.'.php';
             $this->setLayout(include __DIR__ .'./../../resources/views/'.$view.'.php');
             include  __DIR__ .'./../../resources/views/layouts/'.$footerlayout.'.php';


    }
    protected function crsftokenGenerator()
    {
        $_SESSION['_crsftoken'] = md5(uniqid(rand(00000,99999), true));
        require_once  __DIR__ . './../Config/token.php';
    }
    protected function setLayout($layout)
    {
        define('LAYOUT', $layout);
    }

    protected function getLayout()
    {
        return constant('LAYOUT');
    }

    protected function setView($view)
    {
        define('CONTENT', $view);
    }



}