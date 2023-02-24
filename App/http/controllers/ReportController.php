<?php

namespace Ti\Helpdesk\App\http\controllers;


use Ti\Helpdesk\App\Config\Configuration;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Company;
use Ti\Helpdesk\App\Model\Invoice;
use Ti\Helpdesk\App\Model\Payment;
use Ti\Helpdesk\App\Model\Receipt;
use Ti\Helpdesk\App\Model\Penalty;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;

class ReportController extends Controller implements Report
{
	
    public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
	public function index() {
		
		$paidInvoices = Invoice::whereinvoice_status("Paid")->orderByDesc('created_at')->get();
		$notpaidInvoices = Invoice::whereinvoice_status("Not Paid")->orderByDesc('created_at')->get();
		$paidPenalties = Penalty::wherestatus("Paid")->orderByDesc('created_at')->get();
        $month = date('M');
        $year = date('Y');

            $start = strtotime($year .'-'.$month.'-01');
            $end = strtotime($year .'-'.$month.'-31');

         $start_date = $year . '-'. date('m', $start).'-'.'01';
         $end_date = $year . '-'. date('m', $start).'-'.'31';

        $temp_total_discount = Invoice::whereDate('created_at', '>=' , $start_date)->whereDate('created_at', '<=' , $end_date)->sum('total_amt');
		
		 echo json_encode($start_date);
		 echo json_encode($end_date);
		 echo json_encode($temp_total_discount);
		$this->view("administrator/reports/index", "dash", 'adminfooter',
		 [
		 	'payments'=>$payments,
		 	'invoices'=>$paidInvoices,
		 	'notpaidInvoices'=>$notpaidInvoices,
		 	'penalties'=>$paidPenalties,
		 ]);
	}
	/**
	 * @param mixed $date
	 * @return mixed
	 */
	public function companies($date) {

	}
	
	/**
	 *
	 * @param mixed $date
	 * @return mixed
	 */
	public function todayinvoices($date) {
		$date = date('d-m-Y',strtotime($date));
		$invoices = Invoice::wherecreated_at($date);
	}
	
	/**
	 *
	 * @param mixed $date
	 * @return mixed
	 */
	public function receipts($date) {
		$date = date('d-m-Y',strtotime($date));
		$receipts = Receipt::wherecreated_at($date);
	}
	
	/**
	 *
	 * @param mixed $date
	 * @return mixed
	 */
	public function payments($date) {
		$date = date('d-m-Y',strtotime($date));
	 $payments = Payment::wherecreated_at($date);
	}
	
	/**
	 *
	 * @param mixed $date
	 * @return mixed
	 */
	public function systemlogs($date) {
	}
	
	/**
	 *
	 * @param mixed $date
	 * @return mixed
	 */
	public function customersystemlogs($date) {
	}

public function allpayments() {
	$payments = Payment::wherestatus("Paid")->orderByDesc('created_at')->get();
	$this->view("administrator/reports/payments", "dash", 'adminfooter',
	 [
	 	'payments'=>$payments,
	 ]);
}

public function allinvoices() {
	$paidInvoices = Invoice::whereinvoice_status("Paid")->orderByDesc('created_at')->get();
	
	$this->view("administrator/reports/invoices", "dash", 'adminfooter',
	 [
	 	'invoices'=>$paidInvoices
	 ]);
}

public function allnotpaidinvoices() {
	$notpaidInvoices = Invoice::whereinvoice_status("Not Paid")->orderByDesc('created_at')->get();
	$this->view("administrator/reports/unpaidinvoices", "dash", 'adminfooter',
	 [
	 	'invoices'=>$notpaidInvoices,
	 ]);
}



public function allpenalties() {
	$paidPenalties = Penalty::wherestatus("Sent")->orderByDesc('created_at')->get();
	$this->view("administrator/reports/penalty", "dash", 'adminfooter',
	 [
	 	'penalties'=>$paidPenalties,
	 ]);
}





}