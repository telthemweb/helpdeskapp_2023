<?php

namespace Ti\Helpdesk\App\http\controllers;
use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Payment;
use Ti\Helpdesk\App\Model\Receipt;
use Ti\Helpdesk\App\Model\Employeetask;
use Ti\Helpdesk\App\Model\Invoice;
use Ti\Helpdesk\App\Model\Ticket;
use Ti\Helpdesk\App\Model\Penalty;
use Ti\Helpdesk\App\System\Middles\GuestMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Traits\GetRecordTrait;
use Exception;
use Ti\Helpdesk\App\Model\Task;

class CompdashController extends Controller 
{
    use GetRecordTrait;
    public function __construct(){
		(new GuestMiddleware())->redirectIfNotAuthenticated();
	}

    public function index() 
    {
        $this->view("customer/dashboard", 'customerlayout','footer', []);
    }

    public function create() 
    {
        $cat = new Category();
	    $categories = $cat->all();
        $this->view("customer/profile", 'customerlayout','footer',  ['categories'=>$categories]);
    }

	public function invoice($id){
		$session = new SessionManager();
		$task = Task::find($id);
		$findinv = Invoice::wheretask_id($task->id)->first();
		$ticket = Ticket::find($task->ticket_id);
		if($findinv==null){
			$session->setFlash('error', 'Invoice is not yet proccessed!!');
		    $this->back();
		}
		else{
		$this->view("customer/invoiced", 'invoivedash','invofooter', ['invoice'=>$findinv,'ticket'=>$ticket ]);
	}
		}

	public function payment($id,$mode){
		$session = new SessionManager();
		$invoice = Invoice::find($id);
		$invoice->invoice_status = "Paid";

		$invoice->update([$invoice]);

		//post to payment
		$payment = new Payment;
		$payment->invoice_id=$invoice->id;
		$payment->paymentnumber="pmt".random_int(10000,99999)+date(date('YmdHis'));
		$payment->invoice_amount=$invoice->total_amt;
		$payment->amount_paid=$invoice->total_amt;
		$payment->paymentmode=strtoupper($mode);
		$payment->company_id=$_SESSION['user_id'];
		$payment->status='Paid';
		$payment->save();

		//generate Receipt

		$receipt = new Receipt;





		$session->setFlash('success', 'Invoice number '.$invoice->invoicenumber.' has been paid successfully!!');
		$this->back();
	}

	public function completeticket($id){
		$session = new SessionManager();
		$ticket = Ticket::find($id);
		$ticket->status = "Resolved";
		$ticket->update([$ticket]);
		$session->setFlash('success', 'Ticket number '.$ticket->ticket_number.' marked as completed successfully!!');
		$this->back();
	}

    public function createticket() 
    {
		$tickets = Ticket::where('company_id',$_SESSION['user_id'])->orderByDesc('created_at')->get();
		$this->view("customer/create", 'customerlayout','footer', ['tickets' => $tickets]);
	}

    public function viewticket($id) 
    {
        $session = new SessionManager();
		$ticket =  Ticket::find($id);
		$task =  Task::whereticket_id($ticket->id)->first();
        $id = $this->GetTicket($ticket);
        if($id==null){
            $session->setFlash('error', 'Your query is pending,kindly note your query will be accepted shortly');
			$this->back();
        }
        else{
            $employee = Employeetask::where('task_id', $id)->get();
            $this->view("customer/viewticket", 'customerlayout','footer', ['ticket' => $ticket,'emps'=>$employee,'task'=>$task]);
        }
	}

	public function createpenalty($id){
		$session = new SessionManager();
		$task =Task::find($id);
		$penaltstatus = Penalty::wheretask_id($task->id)->first();
		$penalty = new Penalty;

		if($penaltstatus->status=="Sent"){
			$session->setFlash('error', 'Unfortunately you cant send many request!!Please try to call the person assigned to task below!!');
		   $this->back();
		}
		else{
			$comment="You fail to attend to my task number # ".$task->taskcode.' which was supposed to be completed on the '. date('d-M-Y',strtotime($task->task_end));
			$penalty->task_id=$task->id;
			$penalty->company_id= $_SESSION['user_id'];
			$penalty->rate=50.00;
			$penalty->numb_hours=1;
			$penalty->comment=$comment;
			$penalty->status="Sent";
			$penalty->save();
			$session->setFlash('success', 'Complain has been sent successfully.Please will send you an email shortly for feedback!!');
			$this->back();
		}


	}

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

	
		

		$ticket->company_id = $_SESSION['user_id'];
		$ticketnumber = random_int(100000,999999);
		$ticket->ticket_number= 'Tk-'.$ticketnumber;
		$ticket->title= $request->input('title');
		$ticket->description= $request->input('description');
		$ticket->ticketimg= $picticketimg;
		$ticket->ticketdocs= $docticketdocs;
		$ticket->priority= $request->input('priority');
		$ticket->expectedcompleted= $request->input('expectedcompleted');
		$ticket->status= "Pending";
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
	public function showticketbyid($id)
	{
		$ticket =  Ticket::find($id);
		$this->view("customer/edit", "customerlayout", 'footer', ['ticket'=>$ticket]);
	}
	public function updateticket($id)
	{
		$request = new Request;
		$session = new SessionManager();
		$ticket =  Ticket::find($id);
		$ticket->title= $request->input('title');
		$ticket->description= $request->input('description');
		$ticket->priority= $request->input('priority')==null?$ticket->priority:$request->input('priority');
		$ticket->expectedcompleted= $request->input('expectedcompleted');
		$ticket->update([$ticket]);
		$session->setFlash('success', 'Ticket updated successfully!!');
		Configuration::redirection('company/support');
	}


	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function destroy($id) {
		$session = new SessionManager();
		$ticket =  Ticket::find($id);
		 if(count($ticket->tasks)>0){
		 	 $session->setFlash('error', 'Ticket cant be deleted');
		 	 Configuration::redirection('company/support');
		 }else{
		 	 $ticket->delete();
		 	 $session->setFlash('success', 'Ticket  deleted successfully');
		 	 Configuration::redirection('company/support');
		 }
	}

	public function changepassword($id)
	{
		$request = new Request;
		$session = new SessionManager();
		$company =Company::find($id);
		$newpassword =$request->input('newpassword');
		$cnewpassword =$request->input('cnewpassword');
		if($newpassword !=$cnewpassword){
			$session->setFlash('error', 'Password do not match');
		}
		else{
			$options = [
				'cost' => 12,
			];
			$encrypetedpass = password_hash($newpassword, PASSWORD_BCRYPT, $options);
			$company->password = $encrypetedpass;
			$company->update([$company]);
			$session->setFlash('success', 'Password  changed successfully please login with new password');
			Configuration::redirection('logout');
		}
		
	}

    
}