<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;

class CategoryController extends Controller implements Resourcesa
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
    
	/**
	 * @return mixed
	 */
	public function index() {
		$categories =  Category::orderByDesc('created_at')->get();
		$this->view("administrator/category/index", "dash", 'adminfooter', ['categories'=>$categories]);
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
        $cat = new Category();
		$audit = new Audit();
        $cat->name = $request->input('name');

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Category';
		$audit->oldvalue='';
		$audit->newvalue=$request->input('name');
		$audit->action="CREATE_CATEGORY";
		$audit->save([$audit]);
        $cat->save();
		$session->setFlash('success', 'Category created successfully!!');
		$this->back();
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$cats =  Category::find($id);
		$this->view("administrator/category/edit", "dash", 'adminfooter', ['category'=>$cats]);
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$request = new Request;
		$session = new SessionManager();
		$cat = Category::findOrFail($id);
		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Category';
		$audit->oldvalue=$cat->name;
		$audit->newvalue=$request->input('name');
		$audit->action="UPDATE_CATEGORY";
		$audit->save();


		$cat->name = $request->input('name');
		$cat->update([$cat]);
		$session->setFlash('success', 'Category updated successfully!!');
		Configuration::redirection('categories');

		
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
		//$request = new Request;
		$session = new SessionManager();
		$cat = Category::find($id);
		 if(count($cat->companies)>0){
		 	 $session->setFlash('error', 'Category cant be deleted');
		 	 Configuration::redirection('categories');
		 }else{
			$audit = new Audit();
			$audit->administrator_id=$_SESSION['admin_id'];
			$audit->entity='Ti\Helpdesk\App\Model\Category';
			$audit->oldvalue=$cat->name;
			$audit->newvalue='No new value';
			$audit->action="DELETE_CATEGORY";
			$audit->save();
		 	 $cat->delete();
		 	 $session->setFlash('success', 'Category  deleted successfully');
		 	 Configuration::redirection('categories');
		 }
	}
}