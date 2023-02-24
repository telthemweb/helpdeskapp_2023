<div class="container-fluid px-xl-5 mt-lg-5">
    <button class="btn btn-danger float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
        CREATE TASK <i class="fa fa-folder"></i>
    </button>
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">TASKS</b>  </span><small class="px-1 float-lg-right"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Code</th>
                                        <th class="text-center">Task Name</th>
                                        <th class="max-width">Start</th>
                                        <th class="max-width">End</th>
                                        <th class="max-width">Status</th>
                                        <th class="max-width">Date Created</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                    <?php  if(count($tasks)>0): ?>
                                    <?php
                                    $i =0; ?>
                                    <?php foreach ($tasks as $tas): $i++; ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i ?></td>
                                            <td><?php echo $tas->taskcode; ?></td>
                                            <td><?php echo $tas->ticket->title; ?></td>
                                            <td><?php echo date('d-M-Y',strtotime($tas->task_date)); ?></td> 
                                            <td><?php echo date('d-M-Y',strtotime($tas->task_end)); ?> </td>
                                            <?php if($tas->status =="Done"): ?>
                                            
                                            <td class="text-center"><i class="fa fa-check mr-2 text-success"></i></td>
                                            <?php else: ?>
                                                <td><?php echo $tas->status; ?></td>
                                            <?php endif; ?>
                                            <td><?php echo date('d-m-Y',strtotime($tas->created_at)); ?> </td>
                                            <td class="text-center max-width">
                                            <?php if($tas->status !="Done"): ?>
                                            
                                            <a class="text-danger"  href="<?php route('/task/d/'.$tas->id); ?>" >
                                                <i class="fa fa-trash mr-3 text-danger"></i>
                                            </a>
                                            <a class="text-danger"  href="<?php route('/task/v/'.$tas->id); ?>" >
                                                <i class="fa fa-eye mr-3 text-danger"></i>
                                            </a>
                                            <?php else: ?>
                                                <?php if($tas->hasInvoice ==1): ?>
                                                <a class="btn btn-success btn-sm"  href="<?php route('/invoice/v/'.$tas->invoice->id); ?>" >View</a>
                                                <?php else: ?>
                                                <a class="btn btn-primary btn-sm"  href="<?php route('/request/inv/'.$tas->id.'/c/'.$tas->ticket->company_id); ?>" >Invoice</a>
                                                
                                                <?php endif; ?>
                                                
                                                <?php endif; ?>
                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <?php else: ?>
                                        <td colspan="8" class="text-danger text-center"><b>No tasks found</b></td>
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

<div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">CREATE TASK</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/task/register') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="ticket_id" id="ticket_id">
                                        <option value="" disabled selected>Select Ticket</option>
                                        <?php foreach ($tickets as $cust){?>
                                            <option value="<?php echo $cust->id; ?>"><?php echo $cust->id.' | '.$cust->title; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="prioritType" id="prioritType">
                                        <option value="" disabled selected>Select Priority</option>
                                        <option value="Normal">Normal</option>
                                        <option value="High">High</option>
                                        <option value="Extremely">Extremely High</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Start Date</label>
                            <input type="date" class="form-control pl-3" name="task_date"  id="task_date">
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" class="form-control pl-3" name="task_end"  id="task_end">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                                <label for="">Task Comment</label>
                              <input type="text" class="form-control pl-3" name="taskcomment"  id="taskcomment" placeholder="Enter Comment">
                            </div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="float-lg-right">
                            <div class="">
                                <button type="submit" class="btn btn-primary login-btn btn-block">SUBMIT</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

