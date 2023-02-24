<?php

namespace Ti\Helpdesk\App\http\controllers;

use Exception;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Model\Ticket;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;


use Ti\Helpdesk\App\Config\Configuration;
use \Ti\Helpdesk\App\System\Request;


class TicketController extends Controller implements Resourcesa
{
	
    public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
	/**
	 * @return mixed
	 */
	public function index() {
		$tickets =  Ticket::wherestatus('Pending')->orderByDesc('created_at')->get();
		$com = new Company();
		$companies = $com->all();
        $this->view("administrator/support/index", "dash", 'adminfooter', ['tickets' => $tickets,'companies' => $companies]);
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
		try{
			$request = new Request;
		$session = new SessionManager();
		$ticket = new Ticket();

		$ticketimg = $request->fileinput('ticketimg'); 
		$ticketdocs = $request->fileinput('ticketdocs'); //document
		$imgext = pathinfo($ticketimg, PATHINFO_EXTENSION);
		$docext = pathinfo($ticketdocs, PATHINFO_EXTENSION);

		$arryticketimg = strtotime(date('YmdHis'));
		$arryticketdocs = strtotime(date('YmdHis'));


		$timeImg = base64_encode($arryticketimg.random_int(1000,9999)).".".$imgext;
		$timeDoc = base64_encode($arryticketdocs.random_int(0000,9999)).".".$docext;
		
		
		$picticketimg= "uploads/imgs/".$timeImg;
		$docticketdocs= "uploads/documents/".$timeDoc;

	
		

		$ticket->company_id = $request->input('company_id');
		$ticketnumber = random_int(100000,999999);
		$ticket->ticket_number= 'Tk-'.$ticketnumber;
		$ticket->title= $request->input('title');
		$ticket->description= $request->input('description');
		$ticket->ticketimg= $picticketimg;
		$ticket->ticketdocs= $docticketdocs;
		$ticket->priority= $request->input('priority');
		$ticket->expectedcompleted= $request->input('expectedcompleted');
		$ticket->save();
		$session->setFlash('success', 'New Ticket created successfully!!');
		move_uploaded_file($request->filetempinput('ticketimg'), $picticketimg);
		move_uploaded_file($request->filetempinput('ticketdocs'), $docticketdocs);
		$this->back();
		}catch(Exception $ex){
			$session->setFlash('error', $ex->getMessage());
			$this->back();
		}




        

		//other inputs to be called

	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$ticket =  Ticket::find($id);
        $this->view("administrator/support/show", "dash", 'adminfooter', ['ticket' => $ticket,]);
	
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$request = new Request;
		$session = new SessionManager();
		$ticket =  Ticket::find($id);
		$olddata = array();
		$olddata['company_id'] = $ticket->company_id;
		$olddata['id'] = $ticket->id;
		$olddata['ticket_number'] = $ticket->ticket_number;
		$olddata['title'] = $ticket->title;
		$olddata['description'] = $ticket->description;
		$olddata['ticketimg'] = $ticket->ticketimg;
		$olddata['ticketdocs'] = $ticket->ticketdocs;
		$olddata['priority'] = $ticket->priority;
		$olddata['expectedcompleted'] = $ticket->expectedcompleted;
		$myolddata = json_encode($olddata);




		$newdata = array();
		$newdata['title'] =  $request->input('title');
		$newdata['description'] = $request->input('description');
		$newdata['priority'] = $ticket->priority;
		$newdata['expectedcompleted'] = $request->input('expectedcompleted');
		$mynewdata = json_encode($newdata);




		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Ticket';
		$audit->oldvalue=$myolddata;
		$audit->newvalue=$mynewdata;
		$audit->action="UPDATE_TICKET";
		$audit->save();


		$ticket->title= $request->input('title');
		$ticket->description= $request->input('description');
		$ticket->priority= $request->input('priority');
		$ticket->expectedcompleted= $request->input('expectedcompleted');
		$ticket->update([$ticket]);
		$session->setFlash('success', 'Ticket updated successfully!!');
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
	
	}



	public function accept($id) {
		$session = new SessionManager();
		$ticket =  Ticket::find($id);
		$ticket->status = "Accepted";
		$ticket->update([$ticket]);
		$session->setFlash('success', 'Ticket accepted successfully!!');
		$this->back();
	}
	public function reject($id) {
		$session = new SessionManager();
		$ticket =  Ticket::find($id);
		$ticket->status = "Rejected";
		$ticket->update([$ticket]);
		$session->setFlash('success', 'Ticket rejected successfully!!');
		$this->back();
	}
}