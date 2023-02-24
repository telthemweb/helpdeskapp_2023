<?php

namespace Ti\Helpdesk\App\http\controllers;

use Ti\Helpdesk\App\Model\Task;
use Ti\Helpdesk\App\Model\Employeetask;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Administrator;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Model\Ticket;
use \Ti\Helpdesk\App\System\Request;

class TechnicianController extends Controller 
{
    public function __construct()
    {
        (new AdministratorMiddleware())->redirectIfNotAuthenticated();
    }
    
    public function index()
    {
        $user_id = $_SESSION['admin_id'];
        $mytasks = Employeetask::where('administrator_id',$user_id)->wherestatus('Pending')->orderByDesc('created_at')->get();
        $this->view("administrator/technician/index", "dash", "adminfooter",["tasks"=>$mytasks]);
    }

    public function show($id) {
		$task =  Task::find($id);
        $ticket =  Ticket::find($task->ticket_id);
        $company =  Company::find($ticket->company_id);
        $serviceid =  Category::find($company->category_id);
        $this->view("administrator/technician/viewtask", "dash", 'adminfooter', ['task' => $task,'ticket'=>$ticket,'service'=>$serviceid]);
	}

    public function completeTask($id) {
		$session = new SessionManager();
		$task =  Task::find($id);
        $taskemp =  Employeetask::wheretask_id($task->id)->first();
		$task->status = "Done";
        $taskemp->status = "Completed";
		$task->update([$task]);
        $taskemp->update([$taskemp]);
		$session->setFlash('success', 'Task Completed successfully!!');
		$this->back();
	}
    
    
}