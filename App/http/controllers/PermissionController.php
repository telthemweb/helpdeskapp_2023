<?php

namespace Ti\Helpdesk\App\http\controllers;

use Illuminate\Support\Facades\Gate;
use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Permission;
use Ti\Helpdesk\App\Model\Role;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Traits\ValidationInputs;

class PermissionController extends Controller implements Resourcesa
{
 use ValidationInputs;
 public function __construct(){
    (new AdministratorMiddleware())->redirectIfNotAuthenticated();
}
    public function index()
    {
        $permissions =  Permission::orderByDesc('created_at')->get();
        $this->view("administrator/permissions/index", "dash", 'adminfooter', ['permissions'=>$permissions]);

    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function getAssignedByRole($role_id){
           $role=  Role::find($role_id);
           $perm = new Permission;
           $permissions = $perm->all();
            $this->view("administrator/roles/rolepermissions/assign","dash",'adminfooter',[
                'permissions'=>$permissions,
                'role'=>$role
            ]);
       
    }

    public function store()
    {
        $request = new Request;
        $session = new SessionManager();
        $perm = new Permission();

        $data = array();
        $data['name'] = $request->input('name');
        $data['guard_name'] = $request->input('guard_name');
        $mydata = json_encode($data);

        $audit = new Audit();
        $audit->administrator_id=$_SESSION['admin_id'];
        $audit->entity='Ti\Helpdesk\App\Model\Permission';
        $audit->oldvalue = 'N/A';
        $audit->newvalue=$mydata;
        $audit->action="CREATE_PERMISSION";
        $audit->save();

        $perm->name = $request->input('name');
        $perm->guard_name = $request->input('guard_name');
        $perm->save();
        $session->setFlash('success', 'Permission created successfully!!');
        $this->back();

    }

    public function show($id)
    {
        $permission =  Permission::find($id);
		$this->view("administrator/permissions/edit", "dash", 'adminfooter', ['permission'=>$permission]);
    }

    public function edit($id)
    {
        $request = new Request;
		$session = new SessionManager();
		$perm = Permission::find($id);






        $data = array();
		$newdata = array();
		$data['name'] = $perm->name;
		$data['guard_name'] = $perm->guard_name;
        $olddta = json_encode($data);
       
        $newdata['name'] = $request->input('name');
        $newdata['guard_name'] = $request->input('guard_name');
        $newdta = json_encode($newdata);
        $audit = new Audit();
        $audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Permission';
		$audit->oldvalue=$olddta;
		$audit->newvalue=$newdta;
		$audit->action="UPDATE_PERMISSION";
		$audit->save();
		$perm->name = $request->input('name');
        $perm->guard_name = $request->input('guard_name');
		$perm->update([$perm]);
		$session->setFlash('success', 'Permission updated successfully!!');
		Configuration::redirection('permissions');
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        $session = new SessionManager();
        $perms = Permission::find($id);
        $data = array();
		$newdata = array();
		$data['name'] = $perms->name;
		$data['guard_name'] = $perms->guard_name;
        $olddta = json_encode($data);

        $audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Permission';
		$audit->oldvalue=$olddta;
		$audit->newvalue='N/A';
		$audit->action="DELETE_PERMISSION";
		$audit->save();

		$perms->delete();
        $session->setFlash('success', 'Permission  deleted successfully');
        Configuration::redirection('permissions');
    }
}