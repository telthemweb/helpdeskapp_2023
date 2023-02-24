<?php

namespace Ti\Helpdesk\App\Traits;

use Doctrine\ORM\Mapping\Id;
use Ti\Helpdesk\App\Model\Category;
use Ti\Helpdesk\App\Model\Task;
use Ti\Helpdesk\App\Model\Ticket;

trait GetRecordTrait{
    public function GetTicket($ticket):int{
         $tick =0;
        foreach($ticket->tasks as $dv){
            $tick= $dv->id;
        }
        return $tick;
    }



    public function getTCompanys($invoices){
        
        foreach($invoices as $inv){
            return $this->getTask($inv->task_id);
        }
        
    }

    private function getTask($taskid)
    {
        $tasks = Task::whereid($taskid)->get();
        foreach($tasks as $inv){
            return Ticket::whereid($inv->ticket_id)->get();
        }
    }

     public function getDailyInvoices()
     {
        
     }
     public function getWeeklyInvoices(){}
     public function getMonthlyInvoices(){}
     public function getYearlyInvoices(){}

}