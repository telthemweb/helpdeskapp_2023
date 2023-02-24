<div class="container-fluid px-xl-5 mt-lg-5">
<div class="row mb-3">
<div class="col-lg-12 col-md-12">
<div id="switchPoint" class="e-panel card">
<div class="card-header bg-brown">Task Information <b class="float-right"><?php echo "Start Date :". date('d-M-Y',strtotime($task->task_date)); ?></b></div>
<div class="card-body">
<div class="card-title">
    <h6 class="mr-2"><span><?php echo "<b class='text-info'>COMPANY NAME </b> :   ". strtoupper($ticket->company->name); ?> <small class="badge badge-danger p-1"><?php echo $service->name ?></small></span><small class="px-1 float-lg-right"><?php echo "Ticket Number  #". $ticket->ticket_number; ?></small></h6><hr>
</div><br>
<div class="row">
<div class="col-md-2"> 
<img style="border-radius: 0%!important;" src="<?php echo url($ticket->ticketimg==null?'assets/img/done.png':$ticket->ticketimg); ?>" width="123px" alt="<?php echo $ticket->title; ?>">
</div>
<div class="col-md-9">
    <h5 class="mr-lg-5"><?php echo strtoupper($ticket->title); ?></h5>
    <p><?php echo $task->taskcomment; ?></p>
    <?php if($task->status=="Pending"): ?>
    <p>Status  <b class="ml-lg-4 badge badge-danger">  <?php echo $task->status; ?></b></p>
    <?php else: ?>
    <p>Status  <b class="ml-lg-4  badge badge-success p-1">Task Completed</b></p>
    <?php endif; ?>
    <p>Expected Date to Complete Task:  <b><?php echo   date('d-M-Y',strtotime($task->task_end));; ?></b></p>
    
    <?php if($task->status =="Pending"): ?>
     <a class="btn btn-info float-right rounded-0" href="<?php route('/technician/t/'.$task->id) ?>">
       Mark as Completed <i class="fa fa-check mr-2"></i></a>
       <?php endif; ?>
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>