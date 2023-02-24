<?php

namespace Ti\Helpdesk\App\http\controllers;
use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Client;
use Ti\Helpdesk\App\Model\Ticket;
use Ti\Helpdesk\App\System\Middles\AuthClientMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Company;

class ClientController extends Controller 
{
    
    public function __construct()
    {
        (new AuthClientMiddleware())->AuthenticatedUserIdData();
    }

    public function index() {
         $this->view("welcome", "main", 'footer', []);
	}

    public function create() {
        
        $this->view("customer/index", "main", 'footer', []);
   }

   public function register() {
    $cat = new Category();
	$categories = $cat->all();
    $this->view("customer/register", "main", 'footer', ['categories'=>$categories]);
}

public function createauth() {
    $request = new Request;
    $session = new SessionManager();

    $comp = new Company();
    $category_id=$request->input('category_id');
    $name=$request->input('name');
    $city=$request->input('city');
    $address=$request->input('address');
    $googlemaplink=$request->input('googlemaplink');
    $phonenumber=$request->input('phonenumber');
    $email=$request->input('email');
    $password = $request->input('password');
    $nameCheck =  Company::where('name',$name)->count();
    $emailCheck =  Company::where('email',$email)->count();
    $phonenumberCheck =  Company::where('phonenumber',$phonenumber)->count();
    if($nameCheck>0){
        $session->setFlash('error', 'Company name already exist!!');
        $this->back();
    }
    else if($emailCheck>0){
        $session->setFlash('error', 'Company email already exist. Please find another email!!');
        $this->back();
    }
    else if($phonenumberCheck>0 ){
        $session->setFlash('error', 'Company name already exist. Please find another phone number!!');
        $this->back();
    }
    $options = [
        'cost' => 12,
    ];
    $encrypetedpass = password_hash($password, PASSWORD_BCRYPT, $options);
  
    $comp->category_id=$category_id;
    $comp->code= "CO".rand(00,99).date('ymdhms');
    $comp->name=$name;
    $comp->city=$city;
    $comp->address=$address;
    $comp->googlemaplink=$googlemaplink;
    $comp->phonenumber=$phonenumber;
    $comp->password=$encrypetedpass;
    $comp->email=$email;
    $comp->save();
    $session->setFlash('success', 'Company created successfully!!');
    Configuration::redirection('login');
}

public function authenticate()
{
    $request = new Request;
    $session = new SessionManager();
    $email = $request->input('email');
    $password = $request->input('password');

        $clientd = Company::where('email', $email)->count();
        if($clientd>0){
                $client = Company::where('email', $email)->first();
                $veryfypass = password_verify($password, $client->password);
                if($veryfypass==true){
                    $_SESSION['user_id'] = $client->id;
                    $_SESSION['category_id'] = $client->category_id;
                    $_SESSION['code'] = $client->code;
                    $_SESSION['name'] = $client->name;
                    $_SESSION['city'] = $client->city;
                    $_SESSION['googlemaplink'] = $client->googlemaplink;
                    $_SESSION['email'] = $client->email;
                    $_SESSION['address'] = $client->address;
                    $_SESSION['phonenumber'] = $client->phonenumber;
                    $_SESSION['sectorname'] = $client->category->name;
                    $session->setFlash('success', 'Welcome  '.$client->name); 
                    Configuration::redirection('company');
                   
                }else{
                    
                   $session->setFlash('error', 'Incorrect password please try again !!');
                   Configuration::redirection('login');
                   exit();
                }
           
    
        }else{	
            Configuration::redirection('login');
            $session->setFlash('error', 'Incorrect credentials please contact Administrator for account Activation !!');
            exit();
        }
        
    
    

}

public function logout()
{
    unset( $_SESSION['user_id']);
    unset($_SESSION['category_id']);
    unset($_SESSION['code']);
    unset($_SESSION['name']);
    unset($_SESSION['city']);
    unset($_SESSION['googlemaplink']);
    unset($_SESSION['email']);
    unset($_SESSION['address']);
    unset($_SESSION['phonenumber']);
    session_destroy();
    Configuration::redirection('login');
}













}