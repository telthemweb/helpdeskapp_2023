<div class="container px-xl-5 mt-lg-5">
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
<img style="border-radius: 0%!important;" src="<?php echo url($ticket->ticketimg); ?>" width="123px" alt="<?php echo $ticket->ticketimg; ?>">
</div>
<div class="col-md-9">
    <h5 class="mr-lg-5"><?php echo strtoupper($ticket->title); ?></h5>
    <p><?php echo $ticket->description; ?></p>
    <p>Status  <b><?php echo $ticket->status; ?></b></p>
    <p>Expected Date to Complete Task:  <b><?php echo   date('d-M-Y',strtotime($ticket->expectedcompleted));; ?></b></p>
    <p>We attend you from:  <b><?php echo date('d-M-Y',strtotime($task->task_date)); ?></b> 
        <br>We expect to finish on the:  <b><?php echo date('d-M-Y',strtotime($task->task_end)); ?></b>
        <?php if($ticket->status =="Resolved"): ?>
        <?php if($task->status =="Done"): ?>
            <a class="btn btn-success float-right rounded-0" href="<?php route('/company/invoice/'.$task->id)?>"> View Invoice <i class="fa fa-eye mr-2"></i></a> 
        <?php endif; ?>
        <?php endif; ?>
        <?php if($ticket->status =="Accepted"): ?>
            <a class="btn btn-success float-right rounded-0 mr-2" href="<?php route('/company/completeticket/'.$ticket->id)?>"> Mark as completed to view invoice <i class="fa fa-check mr-2"></i></a> 
        <?php endif; ?>
         <?php if( date('d-M-Y') >date('d-M-Y',strtotime($task->task_end))): ?>
         <a class="btn btn-danger float-right rounded-0 mr-2" href="<?php route('/company/penalty/'.$task->id)?>"> Mark as Late <i class="fa fa-check mr-2"></i></a> 
         
          <?php endif; ?>
</p>


<div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span>For your query we have assigned you <?php echo count($emps); ?> Technician(s)</span><small class="px-1"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="max-width">Name</th>
                                        <th class="max-width">Surname</th>
                                        <th class="max-width">Phone Number</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(count($emps)>0): ?>
                                        <?php
                                    $i =0; ?>
                                    <?php foreach ($emps as $e): $i++; ?>
                                    <tr>
                                    <td class="text-center"><?php echo $i ?></td>
                                    <td><?php echo $e->administrator->name; ?></td>
                                    <td><?php echo $e->administrator->surname; ?></td>
                                    <td><?php echo $e->administrator->phone; ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                        <td colspan="8" class="text-center"><b class="text-danger">No Technicians assigned to your query yet!!</b></td>
                                    <?php endif; ?>
                                    </tbody>
                                     </table>
                            </div>
                        </div>
                    </div>
                














</div>
</div>
</div>
</div>
</div>
</div>
</div>