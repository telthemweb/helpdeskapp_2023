<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Permission;
use Ti\Helpdesk\App\Model\Role;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use \Ti\Helpdesk\App\System\Request;


class RoleController extends Controller implements Resourcesa{
    public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
	/**
	 * @return mixed
	 */
	public function index() {
		$rols = new Role();
		$roles = $rols->all();
         $this->view("administrator/roles/index", "dash", 'adminfooter', ['roles' => $roles,]);
	}
	
	/**
	 * @return mixed
	 */
	public function create() {
	}
	
	/**
	 *
	 * @param Request $request
	 * @return mixed
	 */
	
	public function store() {
		$request = new Request;
		$session = new SessionManager();
        $role = new Role();
		
        $role->name = $request->input('name');
        $role->level = $request->input('level');
        $role->save();
		$session->setFlash('success', 'New Role created successfully!!');
		$this->back();
	}
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$role =  Role::find($id);
		$this->view("administrator/roles/edit", "dash", 'adminfooter', ['role'=>$role]);
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$request = new Request;
		$session = new SessionManager();
		$role = Role::find($id);
        $role->name = $request->input('name');
        $role->level = $request->input('level');
		$role->update([$role]);
		$session->setFlash('success', 'Role updated successfully!!');
		Configuration::redirection('roles');
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
		$session = new SessionManager();
		$role = Role::find($id);
		 if(count($role->administrators)>0 && count($role->permissions)>0){
		 	 $session->setFlash('error', 'Role cant be deleted');
		 	 Configuration::redirection('roles');
		 }else{
		 	 $role->delete();
		 	 $session->setFlash('success', 'Role  deleted successfully');
		 	 Configuration::redirection('roles');
		 }
	}

	public function assign(){
		$request = new Request;
		$session = new SessionManager();
		$role = Role::whereid($request->input('role_id'))->first();
		$role->permissions()->attach($request->input('permission_id'));
		$role->save();
		$session->setFlash('success', 'Role  assigned successfully');
		$this->back();
	}

	public function unassign(){
		$request = new Request;
		$session = new SessionManager();
		$role = Role::whereid($request->input('role_id'))->first();
		$role->permissions()->detach($request->input('permission_id'));
		$role->save();
		$session->setFlash('success', 'Role  unassigned successfully');
		$this->back();
	}












}