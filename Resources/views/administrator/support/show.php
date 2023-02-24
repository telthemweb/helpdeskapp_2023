<div class="container-fluid px-xl-5 mt-lg-5">
<div class="row mb-3">
<div class="col-lg-12 col-md-12">
<div id="switchPoint" class="e-panel card">
<div class="card-header bg-brown">Ticket Information <b class="float-right"><?php echo "Created Time  :". date('H:i:s',strtotime($ticket->created_at)); ?></b></div>
<div class="card-body">
<div class="card-title">
    <h6 class="mr-2"><span><?php echo "<b class='text-info'>COMPANY NAME</b> :   ". strtoupper($ticket->company->name); ?></span><small class="px-1 float-lg-right"><?php echo "Ticket Number  #". $ticket->ticket_number; ?></small></h6><hr>
</div><br>
<div class="row">
<div class="col-md-2"> 
<img style="border-radius: 0%!important;" src="<?php echo url($ticket->ticketimg==null?'assets/img/done.png':$ticket->ticketimg); ?>" width="123px" alt="<?php echo $ticket->ticketimg; ?>">
</div>
<div class="col-md-9">
    <h5 class="mr-lg-5"><?php echo strtoupper($ticket->title); ?></h5>
    <p><?php echo $ticket->description; ?></p>
    <p>Status  <b><?php echo $ticket->status; ?></b></p>
    <p>Expected Date to Complete Task:  <b><?php echo   date('d-M-Y',strtotime($ticket->expectedcompleted));; ?></b></p>
    <p>Created At:  <b><?php echo date('d-M-Y',strtotime($ticket->created_at)); ?></b> 
    <?php if($ticket->status =="Pending"): ?>
    <a class="btn btn-success float-right rounded-0" href="<?php route('/ticket/a/'.$ticket->id) ?>">
        Accept Ticket <i class="fa fa-check"></i></a>
        <?php elseif($ticket->status =="Accepted"): ?>
            <a class="btn btn-info float-right rounded-0" href="<?php route('/tasks') ?>">
        Assign Task <i class="fa fa-link mr-2"></i></a>
        <?php elseif($ticket->status =="Done"): ?>
            <a class="btn btn-primary float-right rounded-0" href="<?php route('/ticket/a/'.$ticket->id) ?>">
        Request Payment  <i class="fa fa-file mr-2"></i></a>
        <?php elseif($ticket->status =="Rejected"): ?>
            <a class="btn btn-success float-right rounded-0" href="<?php route('/ticket/a/'.$ticket->id) ?>">
            Accept Ticket <i class="fa fa-check mr-2"></i></a>
        <?php endif; ?>
        <?php if($ticket->status =="Pending"): ?>
    <a class="btn btn-danger float-right rounded-0 mr-2" href="<?php route('/ticket/r/'.$ticket->id) ?>">
       Reject Ticket <i class="fa fa-times"></i></a>
       <?php endif; ?>
</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>