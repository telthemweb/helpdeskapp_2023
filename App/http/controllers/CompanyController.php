<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;

class CompanyController extends Controller implements Resourcesa
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
    
	/**
	 * @return mixed
	 */
	public function index() {
		$session = new SessionManager();
		//if($this->hasPermission('GET_COMPANIES')==true){
        $campanies  =Company::orderByDesc('created_at')->get();
		$categories = Category::orderByDesc('created_at')->get();
         $this->view("administrator/company/index","dash",'adminfooter',[
            'companies' => $campanies,
			'categories' => $categories
        ]);
	}
	
	/**
	 * @return mixed
	 */
	public function create() {
	}
	
	/**
	 * @return mixed
	 */
	public function store() {
		$request = new Request;
		$session = new SessionManager();
		$comp = new Company();
		$data = array();
			$newdata = array();
			$data['category_id'] = $request->input('category_id');
			$data['name'] = $request->input('name');
			$data['city'] = $request->input('city');
			$data['address'] = $request->input('address');
			$data['googlemaplink'] = $request->input('googlemaplink');
			$data['phonenumber'] = $request->input('phonenumber');
			$data['password'] = $request->input('password');
			$data['email'] = $request->input('email');
			$mydata = json_encode($data);

		    $audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Company';
		    $audit->oldvalue = 'No new value';
			$audit->newvalue=$mydata;
			$audit->action="CREATE_COMPANY";
			$audit->save();
        
		$options = [
            'cost' => 12,
        ];
        $encrypetedpass = password_hash('123456', PASSWORD_BCRYPT, $options);
      
		$comp->category_id=$request->input('category_id');
		$comp->code= "CO".rand(00,99).date('ymdhms');
		$comp->name=$request->input('name');
		$comp->city=$request->input('city');
		$comp->address=$request->input('address');
		$comp->googlemaplink=$request->input('googlemaplink');
		$comp->phonenumber=$request->input('phonenumber');
		$comp->password=$encrypetedpass;
		$comp->email=$request->input('email');
        $comp->save();
		$session->setFlash('success', 'Company created successfully!!');
		$this->back();
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$cat = new Category();
		$categories = $cat->all();
		$company =  Company::find($id);
		$this->view("administrator/company/edit", "dash", 'adminfooter', ['company'=>$company,'categories'=>$categories]);
    
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$request = new Request;
		$session = new SessionManager();
		$options = [
            'cost' => 12,
        ];
        $encrypetedpass = password_hash('123456', PASSWORD_BCRYPT, $options);
		$comp = Company::findOrFail($id);
		$comp->category_id=$request->input('category_id');
		$comp->name=$request->input('name');
		$comp->city=$request->input('city');
		$comp->address=$request->input('address');
		$comp->googlemaplink=$request->input('googlemaplink');
		$comp->phonenumber=$request->input('phonenumber');
		$comp->password=$encrypetedpass;
		$comp->email=$request->input('email');
		$comp->update([$comp]);
		$session->setFlash('success', 'Company updated successfully!!');
		Configuration::redirection('companies');
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
		$session = new SessionManager();
		$cat = Company::find($id);
		$cat->delete();
		$session->setFlash('success', 'Company  deleted successfully');
		Configuration::redirection('companies');
	}
}
