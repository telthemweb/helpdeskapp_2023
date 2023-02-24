<?php

namespace Ti\Helpdesk\App\http\controllers;

use DateTime;
use Ti\Helpdesk\App\Model\Audit;
use Ti\Helpdesk\App\Model\Invoice;

use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Task;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Model\Ticket;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Middles\AuthAdminMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Traits\GetRecordTrait;


class InvoiceController extends Controller implements Resourcesa
{
	use GetRecordTrait;
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
	/**
	 * @return mixed
	 */
	public function index() {
		$tickets = Ticket::orderByDesc('created_at')->get();
		$invoices=  Invoice::orderByDesc('created_at')->get();
        $this->view("administrator/accounts/invoices/index", "dash", 'adminfooter', ['invoices'=>$invoices,'tickets'=>$tickets]);
	}
	
	/**
	 * @return mixed
	*/
	public function create() {}
	
	/**
	 * @return mixed
	*/
	public function store() {


		$request = new Request;
		$newdata = array();
		$newdata['price'] = $request->input('price');
		$newdata['qty'] = $request->input('qty');
		$newdata['discountperc'] = $request->input('discountperc');
		$newdata['discountamount'] = $request->input('discountamount');
		$newdata['tax_perc'] = $request->input('tax_perc');
		$newdata['taxamount'] = $request->input('taxamount');
		$newdata['sub_total'] = $request->input('sub_total');
		$newdata['total_amt'] = $request->input('total_amt');
		$newdata['invoice_note'] = $request->input('invoice_note');
		$newdata['invoice_due_date'] = $request->input('invoice_due_date');
		$mynewdata = json_encode($newdata);
		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Invoice';
		$audit->oldvalue='N/A';
		$audit->newvalue=$mynewdata;
		$audit->action="CREATE_INVOICE";
		$audit->save();




		$task_id = $request->input('task_id');
		$company_id = $request->input('company_id');
		$invoicenumber= "inv".random_int(10000,99999)+date(date('YmdHis'));
		$administrator_id= $_SESSION['admin_id'];
		$price= $request->input('price');
		$qty= $request->input('qty');
		$discountperc= $request->input('discountperc');
		$discountamount= $request->input('discountamount');
		$tax_perc= $request->input('tax_perc');
		$taxamount= $request->input('taxamount');
		$sub_total= $request->input('sub_total');
		$total_amt= $request->input('total_amt');
		$invoice_note= $request->input('invoice_note');
		$invoice_status= "Not Paid";
		$invoice_due_date= $request->input('invoice_due_date');


		$session = new SessionManager();
		$invCheck =  Invoice::where('task_id',$task_id)->count();
		$task = Task::find($task_id);
		if($invCheck==0){
			$inv = new Invoice();
			$inv->administrator_id = $administrator_id;
			$inv->task_id = $task_id;
			$inv->invoicenumber = $invoicenumber;
			$inv->qty = $qty;
			$inv->price = $price;
			$inv->discountperc = $discountperc;
			$inv->discountamount = $discountamount;
			$inv->tax_perc = $tax_perc;
			$inv->taxamount = $taxamount;
			$inv->sub_total = $sub_total;
			$inv->total_amt = $total_amt;
			$inv->invoice_note = $invoice_note;
			$inv->invoice_due_date = $invoice_due_date;
			$inv->invoice_status = $invoice_status;
			$inv->company_id = $company_id;
			$inv->save();
			$task->hasInvoice = 1;
		    $task->update([$task]);
			$session->setFlash('success', 'New invoice created successfully!!');
			$this->back();
		}
		else{
			$session->setFlash('error', 'Invoice already added to the Task List!!');
			$this->back();
		}
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function show($id) {
		$findinv = Invoice::find($id);
		$task = Task::find($findinv->task_id);
		$ticket = Ticket::find($task->ticket_id);
		// echo json_encode($ticket->company->name);
		// $company = null;
		
        $this->view("administrator/accounts/invoices/templateinv", "invoivedash", 'invofooter', ['invoice'=>$findinv,'ticket'=>$ticket ]);
	}
	public function findby($id) {
		$findinv = Invoice::find($id);
		$task = Task::find($findinv->task_id);
		$ticket = Ticket::find($task->ticket_id);
        $this->view("administrator/accounts/invoices/edit", "dash", 'adminfooter', ['invoice'=>$findinv,'ticket'=>$ticket ]);
	}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	 */
	public function edit($id) {
		$session = new SessionManager();
		$request = new Request;
		$inv = Invoice::findOrFail($id);

		$audit = new Audit();

		$data = array();
		$newdata = array();
		$data['price'] = $inv->price;
		$data['qty'] = $inv->qty;
		$data['discountperc'] = $inv->discountperc;
		$data['discountamount'] = $inv->discountamount;
		$data['tax_perc'] = $inv->tax_perc;
		$data['taxamount'] = $inv->taxamount;
		$data['sub_total'] = $inv->sub_total;
		$data['total_amt'] = $inv->total_amt;
		$data['invoice_note'] = $inv->invoice_note;
		$data['invoice_due_date'] = $inv->invoice_due_date;
		$mydata = json_encode($data);

		$newdata['price'] = $request->input('price');
		$newdata['qty'] = $request->input('qty');
		$newdata['discountperc'] = $request->input('discountperc');
		$newdata['discountamount'] = $request->input('discountamount');
		$newdata['tax_perc'] = $request->input('tax_perc');
		$newdata['taxamount'] = $request->input('taxamount');
		$newdata['sub_total'] = $request->input('sub_total');
		$newdata['total_amt'] = $request->input('total_amt');
		$newdata['invoice_note'] = $request->input('invoice_note');
		$newdata['invoice_due_date'] = $request->input('invoice_due_date');

		$mynewdata = json_encode($newdata);

		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Invoice';
		$audit->oldvalue=$mydata;
		$audit->newvalue=$mynewdata;
		$audit->action="UPDATE_INVOICE";
		$audit->save();


		$inv->task_id = $request->input('task_id');
		$inv->company_id = $request->input('company_id');
		$inv->qty = $request->input('qty');
		$inv->price =$request->input('price');
		$inv->discountperc = $request->input('discountperc');
		$inv->discountamount= $request->input('discountamount');
		$inv->tax_perc= $request->input('tax_perc');
		$inv->taxamount= $request->input('taxamount');
		$inv->sub_total= $request->input('sub_total');
		$inv->total_amt= $request->input('total_amt');
		$inv->invoice_note= $request->input('invoice_note');
		$inv->invoice_due_date= $request->input('invoice_due_date');
		$inv->update([$inv]);
		$session->setFlash('success', 'Invoice updated successfully!!');
		Configuration::redirection('invoices');
}
	
	/**
	 * @return mixed
	*/
	public function update() {}
	
	/**
	 *
	 * @param mixed $id
	 * @return mixed
	*/
	public function destroy($id) {
		$session = new SessionManager();
		$inv = Invoice::find($id);
		$data = array();
		$data['price'] = $inv->price;
		$data['qty'] = $inv->qty;
		$data['discountperc'] = $inv->discountperc;
		$data['discountamount'] = $inv->discountamount;
		$data['tax_perc'] = $inv->tax_perc;
		$data['taxamount'] = $inv->taxamount;
		$data['sub_total'] = $inv->sub_total;
		$data['total_amt'] = $inv->total_amt;
		$data['invoice_note'] = $inv->invoice_note;
		$data['invoice_due_date'] = $inv->invoice_due_date;
		$mydata = json_encode($data);
		$audit = new Audit();
		$audit->administrator_id=$_SESSION['admin_id'];
		$audit->entity='Ti\Helpdesk\App\Model\Invoice';
		$audit->oldvalue=$mydata;
		$audit->newvalue='N/A';
		$audit->action="DELETE_INVOICE";
		$audit->save();

		$inv->delete();
		$session->setFlash('success', 'Invoice  deleted successfully');
		Configuration::redirection('invoices');
	}

    
}