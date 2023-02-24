<?php

namespace Ti\Helpdesk\App\http\controllers;

use DateTime;
use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Model\Invoice;
use Ti\Helpdesk\App\Model\Receipt;
use Ti\Helpdesk\App\Model\Systemlogs;
use Ti\Helpdesk\App\Model\Ticket;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Model\Administrator;
use Ti\Helpdesk\App\Model\Employeetask;
use Ti\Helpdesk\App\Model\Role;
use Spatie\Permission\Models\Permission;
use Ti\Helpdesk\App\Model\Payment;
use Ti\Helpdesk\App\Model\Penalty;
use Ti\Helpdesk\App\Traits\Permissiondata;

class DashboardController extends Controller implements Resourcesa{
	use Permissiondata;
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}

	/**
	 * @return mixed
	 */
	public function index() {
		
		$emp = new Administrator;
		$cm = new Company;
		$inv = new Invoice;
		$rep = new Receipt;
		$pay = new Payment;
		$penaltie = new Penalty;
		$total = Ticket::wherestatus('Pending')->count();
		$employeesCount = $emp->count();
        $customersCount=$cm->count();
		$invoiceCount=$inv->count();
		$invoicessum = $inv->whereinvoice_status('Paid')->sum('total_amt');
		$invoicespendingsum = $inv->whereinvoice_status('Pending')->sum('total_amt');
		$fullpayment= $pay->sum('amount_paid');
		$balancepayment= $pay->sum('amount_left');
		$receiptpayment= $rep->sum('amount');
		$penaltcout= $penaltie->sum('rate');
		 $user_id = $_SESSION['admin_id'];
        $mytasks = Employeetask::where('administrator_id',$user_id)->wherestatus('Completed')->orderByDesc('created_at')->get();

		//Paid data
		//paid
		// echo $total;


      $this->view("administrator/index", "dash", 'adminfooter', [
		'totalticket'=>$total,
		'employeesCount'=>$employeesCount,
		'customersCount'=>$customersCount,
		'invoiceCount'=>$invoiceCount,
		'invoicessum'=>$invoicessum,
		'invoicespendingsum'=>$invoicespendingsum,
		'fullpayment'=>$fullpayment,
		'balancepayment'=>$balancepayment,
		'receiptpayment'=>$receiptpayment,
		'penaltcout'=>$penaltcout,
		"tasks"=>$mytasks
	  ]);
	
	
	}

	public function users()
    {
		$session = new SessionManager();
        $dataemp =  Administrator::orderByDesc('created_at')->get();
		$role = new Role();
		$roles = $role->all();
         $this->view("administrator/employees/index","dash",'adminfooter',[
            'administrators' => $dataemp,
			'roles' => $roles
        ]);
    }
	
	/**
	 * @return mixed
	 */
	public function create() {}
	
	/**
	 * @return mixed
	 */
	public function store() {
		$session = new SessionManager();
		if($this->hasPermission('CREATE_EMPLOYEE')==true){
		$request = new Request;
		$admin = new Administrator();

		$data = array();
		$newdata = array();
		$data['name'] = $request->input('name');
		$data['surname'] = $request->input('surname');
		$data['role_Id'] = $request->input('role_Id');
		$data['username'] = $request->input('username');
		$data['address'] = $request->input('address');
		$data['gender'] = $request->input('gender');
		$data['country'] = $request->input('country');
		$data['email'] = $request->input('email');
		$data['phone'] = $request->input('phone');
		$data['province'] = $request->input('province');
		$data['city'] = $request->input('city');
		$mydata = json_encode($data);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Administrator';
		$audit->oldvalue = 'N/A';
		$audit->newvalue=$mydata;
		$audit->action="CREATE_EMPLOYEE";
		$audit->save();




        $options = [
            'cost' => 12,
        ];
        $encrypetedpass = password_hash($request->input('password'), PASSWORD_BCRYPT, $options);
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->role_Id = $request->input('role_Id');
        $admin->username = $request->input('username');
        $admin->password =$encrypetedpass;
        $admin->address = $request->input('address');
        $admin->gender = $request->input('gender');
        $admin->country = $request->input('country');
        $admin->email = $request->input('email');
        $admin->phone = $request->input('phone');
        $admin->province = $request->input('province');
        $admin->city = $request->input('city');
        $admin->save();
        $this->back();
        $session->setFlash('success', $admin->name.' '.$admin->surname .'created successfully !!"');
	}
	else{
		$session->setFlash('error','Sorry! You are not allowed to access this module!!');
		$this->back();
	}
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$role = new Role();
		$roles = $role->all();
		$admin =  Administrator::find($id);
		$this->view("administrator/employees/edit", "dash", 'adminfooter', ['administrator'=>$admin,'roles'=>$roles]);
    
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$request = new Request;
		$admin = Administrator::find($id);
		$session = new SessionManager();
		$olddata = array();
		$olddata['name'] = $admin->name;
		$olddata['surname'] = $admin->surname;
		$olddata['role_Id'] = $admin->role_Id;
		$olddata['username'] = $admin->username;
		$olddata['address'] = $admin->address;
		$olddata['gender'] = $admin->gender;
		$olddata['country'] = $admin->country;
		$olddata['email'] = $admin->email;
		$olddata['phone'] = $admin->phone;
		$olddata['province'] = $admin->province;
		$olddata['city'] = $admin->city;
		$myolddata = json_encode($olddata);

		$newdata = array();
		$newdata['name'] = $request->input('name');
		$newdata['surname'] = $request->input('surname');
		$newdata['role_Id'] = $request->input('role_Id')==null?$admin->role_Id:$request->input('role_Id');
		$newdata['role_status'] = $request->input('role_Id')==null?"Not changed":"Role Changed  ".$admin->role->name;
		$newdata['username'] = $request->input('username');
		$newdata['address'] = $request->input('address');
		$newdata['gender'] = $request->input('gender');
		$newdata['country'] = $request->input('country');
		$newdata['email'] = $request->input('email');
		$newdata['phone'] = $request->input('phone');
		$newdata['province'] = $request->input('province');
		$newdata['city'] = $request->input('city');
		$mydata = json_encode($newdata);

		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Administrator';
		$audit->oldvalue = $myolddata;
		$audit->newvalue=$mydata;
		$audit->action="UPDATE_EMPLOYEE";
		$audit->save();


	$options = [
				'cost' => 12,
			];
			$encrypetedpass = $request->input('password')==null?$admin->password:password_hash($request->input('password'), PASSWORD_BCRYPT, $options);
			$admin->name = $request->input('name');
			$admin->surname = $request->input('surname');
			$admin->role_Id = $request->input('role_Id')==null?$admin->role_Id:$request->input('role_Id');
			$admin->username = $request->input('username');
			$admin->password =$encrypetedpass;
			$admin->address = $request->input('address');
			$admin->gender = $request->input('gender')==null?$admin->gender: $request->input('gender');
			$admin->country = $request->input('country')==null?$admin->country:$request->input('country');
			$admin->email = $request->input('email');
			$admin->phone = $request->input('phone');
			$admin->province = $request->input('province');
			$admin->city = $request->input('city');
			$admin->update([$admin]);
			$session->setFlash('success', 'Employee updated successfully!!');
			Configuration::redirection('employees');
	}

	public function deactivate($id) {
		$session = new SessionManager();
		if($this->hasPermission('DEACTIVATE_ACCOUNT')==true){
			$admin =  Administrator::find($id);
			$role = Role::find($_SESSION['role_Id']);
			if($admin->role_Id==$_SESSION['role_Id']){
				$session->setFlash('error','You cant block yourself!!');
				$this->back();	
			}
			else{
				$newdata = array();
				$newdata['name'] = $admin->name;
				$newdata['surname'] = $admin->surname;
				$newdata['role_Id'] = $admin->role_Id;
				$newdata['username'] = $admin->username;
				$newdata['address'] = $admin->address;
				$newdata['gender'] = $admin->gender;
				$newdata['country'] = $admin->country;
				$newdata['email'] = $admin->email;
				$newdata['phone'] = $admin->phone;
				$newdata['province'] = $admin->province;
				$newdata['city'] = $admin->city;
				$newdata['status'] = $admin->status;
				$myolddata = json_encode($newdata);
				$audit = new Audit();
				$audit->administrator_id=$_SESSION['admin_id'];
				$audit->entity='Ti\Helpdesk\App\Model\Administrator';
				$audit->oldvalue = $myolddata;
				$audit->newvalue = '1';
				$audit->action="DEACTIVATE_ACCOUNT";
				$audit->save();

				$admin->status= 1;
				$admin->update([$admin]);
				$session->setFlash('success', $admin->name.' Account has been blocked!!');
				$this->back();	
			}
		}
		else{
			$session->setFlash('error','Sorry! You are not allowed to access this module!!');
			$this->back();
		}
		
		
	}

	public function activate($id) {
		$session = new SessionManager();
		if ($this->hasPermission('ACTIVATE_ACCOUNT') == true) {
			$admin = Administrator::find($id);
			$role = Role::find($admin->role_id);

			$newdata = array();
			$newdata['name'] = $admin->name;
			$newdata['surname'] = $admin->surname;
			$newdata['role_Id'] = $admin->role_Id;
			$newdata['username'] = $admin->username;
			$newdata['address'] = $admin->address;
			$newdata['gender'] = $admin->gender;
			$newdata['country'] = $admin->country;
			$newdata['email'] = $admin->email;
			$newdata['phone'] = $admin->phone;
			$newdata['province'] = $admin->province;
			$newdata['city'] = $admin->city;
			$newdata['status'] = $admin->status;
			$myolddata = json_encode($newdata);
			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Administrator';
			$audit->oldvalue = '0';
			$audit->newvalue = 'N/A';
			$audit->action="ACTIVATE_ACCOUNT";
			$audit->save();



			$admin->status = 0;
			$admin->update([$admin]);
			$session->setFlash('success', $admin->name . ' Account has been activated!!');
			$this->back();
		}else{
			$session->setFlash('error','Sorry! You are not allowed to access this module!!');
			$this->back();
		}
		
	}
	
	/**
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
		$admin = Administrator::find($id);
		$newdata = array();
		$newdata['name'] = $admin->name;
		$newdata['surname'] = $admin->surname;
		$newdata['role_Id'] = $admin->role_Id;
		$newdata['username'] = $admin->username;
		$newdata['address'] = $admin->address;
		$newdata['gender'] = $admin->gender;
		$newdata['country'] = $admin->country;
		$newdata['email'] = $admin->email;
		$newdata['phone'] = $admin->phone;
		$newdata['province'] = $admin->province;
		$newdata['city'] = $admin->city;
		$myolddata = json_encode($newdata);
		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Administrator';
		$audit->oldvalue = $myolddata;
		$audit->newvalue = 'N/A';
		$audit->action="DELETE_EMPLOYEE";
		$audit->save();
	}

	public function penalty(){
		$penalties = Penalty::orderByDesc('created_at')->get();
		$this->view("administrator/accounts/penalty/index", "dash", 'adminfooter', ['penalties'=>$penalties]);
    
	}
	public function audittray(){
		$audits = Audit::orderByDesc('created_at')->get();
		$this->view("administrator/audit/index", "dash", 'adminfooter', ['audits'=>$audits]);
    
	}
	public function systemlogs(){
		$logs = Systemlogs::orderByDesc('created_at')->get();
		$this->view("administrator/audit/logs", "dash", 'adminfooter', ['logs'=>$logs]);
    
	}

	public function getAdminProfile(){
        $admin_id =$_SESSION['admin_id'];
        $administrator= (new Administrator())->find($admin_id);
        return $this->view("administrator/profile","dash",'adminfooter',[
            'admin' => $administrator,]);
    }
	public function changepassword(){
        $admin_id =$_SESSION['admin_id'];
		$admin = Administrator::find($admin_id);
        return $this->view("administrator/changepassword","dash",'adminfooter',[
            'admin' => $admin,]);
    }
	public function changepasswordpost(){
        $admin_id =$_SESSION['admin_id'];
        

		$request = new Request;
		$session = new SessionManager();
		$admin = Administrator::find($admin_id);
		$newpassword =$request->input('newpassword');
		$cnewpassword =$request->input('cnewpassword');
		$olddata = array();
		$olddata['name'] = $admin->name;
		$olddata['surname'] = $admin->surname;
		$olddata['role_Id'] = $admin->role_Id;
		$olddata['username'] = $admin->username;
		$olddata['address'] = $admin->address;
		$olddata['gender'] = $admin->gender;
		$olddata['country'] = $admin->country;
		$olddata['email'] = $admin->email;
		$olddata['phone'] = $admin->phone;
		$olddata['password'] = $admin->password;
		$olddata['province'] = $admin->province;
		$olddata['city'] = $admin->city;
		$myolddata = json_encode($olddata);

		$newdata = array();
		$newdata['new password'] = $newpassword;
		$options = [
			'cost' => 12,
		];
		$encrypetedpassd = password_hash($newpassword, PASSWORD_BCRYPT, $options);
		$newdata['token'] = base64_encode($encrypetedpassd);
		$mynewdata = json_encode($newdata);
		

		  $audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Administrator';
			$audit->oldvalue = $myolddata;
			$audit->newvalue = $mynewdata;
			$audit->action="CHANGE_PASSWORD";
			$audit->save();

		
		if($newpassword !=$cnewpassword){
			$session->setFlash('error', 'Password do not match');
		}
		else{
			$options = [
				'cost' => 12,
			];
			$encrypetedpass = password_hash($newpassword, PASSWORD_BCRYPT, $options);
			$admin->password = $encrypetedpass;
			$admin->update([$admin]);
			$session->setFlash('success', 'Password  changed successfully please login with new password');
			Configuration::redirection('admin/logout');
		}
    }

    public function acceptPenaltiesinvoice($penaltyId){
		$penailty = Penalty::find($penaltyId);
        $this->view("administrator/accounts/penalty/show","dash","adminfooter",[
         'penalty' => $penailty]);
    }


  public function acceptPenaltiesinvoicestore($penaltyId){
       $session = new SessionManager();
		$penalty = Penalty::find($penaltyId);
		if($penalty->administrator_id !=null){
			$session->setFlash('error', 'Penalty is already Paid!!(*/\*)');
		   $this->back();
		}
		$penalty->administrator_id=$_SESSION['admin_id'];
		$penalty->update([$penalty]);
		$session->setFlash('success', 'Payment paid successfully!!');
		$this->back();
    }




}