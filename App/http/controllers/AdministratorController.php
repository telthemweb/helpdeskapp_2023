<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\System\Middles\AuthAdminMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Model\User;
use Ti\Helpdesk\App\Model\Systemlogs;

class AdministratorController extends Controller implements Resourcesa
{
	
	//Global ;
	/**
	 * @return mixed
	 */
	public function index() {
		(new AuthAdminMiddleware())->AuthenticatedUserIdData();
        return $this->view("administrator/login", "admin", 'adminfooter', []);
	}
	

	public function loginUser(){
		 $log = new  Systemlogs();
		$request = new Request;
		$session = new SessionManager();
		$username = $request->input('username');
		$password = $request->input('password');
		$check= str_starts_with($username, "Ewc");
		if($check==false){
			$session->setFlash('error', 'Username is incorrect format please contact Administrator username start with Ewc');
			Configuration::redirection('admin/login');
		}
		else{
			$admin = (new User())->findBy('username="'.$username.'"');
			if($admin != NULL){
				if($admin->status=="0"){
					$veryfypass = password_verify($password, $admin->password);
					if($veryfypass==true){
						$_SESSION['admin_id'] = $admin->id;
						$_SESSION['name'] = $admin->name;
						$_SESSION['surname'] = $admin->surname;
						$_SESSION['email'] = $admin->email;
						$_SESSION['phone'] = $admin->phone;
						$_SESSION['username'] = $admin->username;
						$_SESSION['gender'] = $admin->gender;
						$_SESSION['country'] = $admin->country;
						$_SESSION['province'] = $admin->province;
						$_SESSION['city'] = $admin->city;
						$_SESSION['role_Id'] = $admin->role_Id;
						$_SESSION['address'] = $admin->address;
						$_SESSION['maxtask'] = $admin->address;
						$_SESSION['isActive'] = $admin->isOut;
						Configuration::redirection('dashboard');
						$session->setFlash('success', 'Welcome '.$admin->name.' '.$admin->surname);
						//add logs
						$log->administrator_id =$admin->id;
						$log->timein=date('H:i:s');
						$log->ipaddress=$_SERVER['REMOTE_ADDR'];
						$log->geolocationap="";
						$log->useaccountname= $admin->name .' '.$admin->surname;
						$log->timeout="Pending";
						$log->save();
					}else{
						
						Configuration::redirection('admin/login');
					   $session->setFlash('error', 'Incorrect password please try again !!');
						exit();
					}
				}
				else{
					Configuration::redirection('admin/login');
					   $session->setFlash('error', 'Your account has been blocked please contact Administrator !!');
						exit();
				}
		
			}else{	
				Configuration::redirection('admin/login');
			    $session->setFlash('error', 'Incorrect credentials please contact Administrator for account Activation !!');
				exit();
			}
			
		}
		

	}

	
	
	/**
	 * @return mixed
	 */
	public function create() {
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
	}
	
	/**
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function update() {
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function destroy($id) {
	}
	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function store() {
		//Administrator::create($request->all());
	}

	public function logout()
    {
		$log = Systemlogs::wheretimeout('Pending')->wherestatus('Pending')->whereadministrator_id($_SESSION['admin_id'])->first();
		//add logs
		$log->administrator_id =$_SESSION['admin_id'];
		$log->ipaddress=$_SERVER['REMOTE_ADDR'];
		$log->geolocationap="";
		$log->status="Logged out";
		$log->useaccountname = $_SESSION['name'] . ' ' . $_SESSION['surname'];
		$log->timeout=date('H:i:s');;
		$log->update([$log]);

		unset($_SESSION['admin_id']);
		unset($_SESSION['name']);
		unset($_SESSION['surname']);
		unset($_SESSION['email']);
		unset($_SESSION['phone']);
		unset($_SESSION['username']);
		unset($_SESSION['gender']);
		unset($_SESSION['country']);
		unset($_SESSION['province']);
		unset($_SESSION['city']);
		unset($_SESSION['city']);
		unset($_SESSION['address']);
		unset($_SESSION['maxtask']);
		unset($_SESSION['isActive']);
		
        session_destroy();
        Configuration::redirection('admin/login');
    }
}