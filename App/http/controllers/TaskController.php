<?php

namespace Ti\Helpdesk\App\http\controllers;

use Ti\Helpdesk\App\Model\Task;
use Ti\Helpdesk\App\Model\Employeetask;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Administrator;
use Ti\Helpdesk\App\Model\Ticket;
use \Ti\Helpdesk\App\System\Request;

class TaskController extends Controller implements Resourcesa
{
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
    
	/**
	 * @return mixed
	 */
	public function index() {
		$tickets = Ticket::wherestatus('Accepted')->orderByDesc('created_at')->get();
		$tasks = Task::orderByDesc('created_at')->get();
		$this->view("administrator/tasks/index", "dash", 'adminfooter', ['tasks'=>$tasks,'tickets'=>$tickets]);
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
		$ticket_id = $request->input('ticket_id');
		$taskcode= "TR".random_int(10000,99999);
		$taskcomment= $request->input('taskcomment');
		$prioritType= $request->input('prioritType');
		$task_date= $request->input('task_date');
		$task_end= $request->input('task_end');
		$assignedby= $_SESSION['name'].' '.$_SESSION['surname']; 
		$session = new SessionManager();
		$ticket =  Task::where('ticket_id',$ticket_id)->count();;
		if($ticket==0){
			$task = new Task();
			$task->ticket_id = $ticket_id;
			$task->taskcode = $taskcode;
			$task->taskcomment = $taskcomment;
			$task->prioritType = $prioritType;
			$task->task_date = $task_date;
			$task->task_end = $task_end;
			$task->assignedby = $assignedby;
			$task->status = 'Pending';
			$task->save();
			$session->setFlash('success', 'Task created successfully!!');
			$this->back();
		}
		else{
			$session->setFlash('error', 'This Ticket is already added to the Task List!!');
			$this->back();
		}
       
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$tasks =  Task::where('ticket_id',$id)->get();
		$ticket = Ticket::find($id);
        $this->view("administrator/tasks/assign", "dash", 'adminfooter', ['ticket' => $ticket,'tasks'=>$tasks]);
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
	 * @param mixed $id
	 * @return mixed
	 */
	public function employeetasks($id){
		$a = new Administrator();
		$administrators = $a->all();
		$task =  Task::find($id);
		$assignedUsers = Employeetask::where('task_id',$id)->get();
        $this->view("administrator/tasks/emptasks", "dash", 'adminfooter', ['task' => $task,'admins'=>$assignedUsers,'administrators'=>$administrators]);
	}
	
	public function assignEmployee(){
		$request = new Request;
		$session = new SessionManager();
		//$admin = new Administrator();
		$task_id = $request->input('task_id');
		$administrator_id = $request->input('administrator_id');
		$mailremider = 1;
		$remindAdminNotDone = 1;
		if($administrator_id !=$_SESSION['admin_id']){
			$findAdmin = Employeetask::where('administrator_id',$administrator_id)->count();
				$emptask = new Employeetask();
				$emptask->task_id = $task_id;
				$emptask->administrator_id = $administrator_id;
				$emptask->mailremider = $mailremider;
				$emptask->remindAdminNotDone = $remindAdminNotDone;
				$emptask->save();
				$session->setFlash('success', 'Technicians Task created successfully!!');
				//Update Record;
				
				$admin = Administrator::findOrFail($administrator_id);
				$record = $admin->maxtask==null?"0":$admin->maxtask;
				$admin->maxtask= $record+1;
				$admin->update([$admin]);
				$this->back();
			
		}else{
			$session->setFlash('error', 'You cant assign yourself to task!!');
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
		$session = new SessionManager();
		$emptask = Employeetask::find($id);
		$emptask->delete();
		$session->setFlash('success', 'Admin unassigned successfully');
		$this->back();
	}
	public function destroyme($id,$administrator_id) {
		$session = new SessionManager();
		$emptask = Employeetask::find($id);
		$admin = Administrator::findOrFail($administrator_id);
		$record = $admin->maxtask==null?"0":$admin->maxtask;
		$admin->maxtask= $record-1;
		$admin->update([$admin]);
		$emptask->delete();
		$session->setFlash('success', 'Admin unassigned successfully');
		$this->back();
	}

	public function requestInvoice($id,$company){
		$task = Task::find($id);
      $this->view("administrator/accounts/invoices/create", "dash", 'adminfooter', ['task'=>$task,'company_id'=>$company]);
	}
}