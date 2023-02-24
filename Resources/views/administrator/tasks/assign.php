<div class="container-fluid px-xl-5 mt-lg-5">
    <button class="btn btn-danger float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
        Assign Technician <i class="fa fa-folder"></i>
    </button>
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">Ticket Title: </b> <?php echo strtoupper($ticket->title); ?> </span><small class="px-1 float-lg-right"><?php echo "Ticket Number  #". $ticket->ticket_number; ?></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Code</th>
                                        <th class="max-width">Assigned to</th>
                                        <th class="max-width">Start</th>
                                        <th class="max-width">End</th>
                                        <th class="max-width">Status</th>
                                        <th class="max-width">Assigned By</th>
                                        <th class="max-width">Date Assigned</th>
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
                                            <td><?php echo $tas->administrator->name.' '.$tas->administrator->surname; ?></td>
                                            <td><?php echo date('d-M-Y',strtotime($tas->task_date)); ?></td> 
                                            <td><?php echo date('d-M-Y',strtotime($tas->task_end)); ?> </td>
                                            <td><?php echo $tas->status; ?></td>
                                            <td><?php echo $_SESSION['name'].' '.$_SESSION['surname'] ; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($tas->created_at)); ?> </td>
                                            <td class="text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-2">
                                                   
                                                        <a class="text-success"  href="<?php route('/perm/update/'.$tas->id); ?>" >
                                                            <i class="fa fa-edit mr-3 text-green"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-2">
                                                    <a class="text-danger"  href="<?php route('/perm/update/'.$tas->id); ?>" >
                                                            <i class="fa fa-trash mr-3 text-danger"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <?php else: ?>
                                        <td colspan="3" class="text-danger text-center"><b>No tasks found</b></td>
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
                <h5 class="modal-title text-white">New ASSIGNED</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/perm/register'); ?>" method="POST">
                        <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                            <div class="rounded-0">
                                <input type="text" class="form-control pl-3" name="name" placeholder="Permission Name" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rounded-0">
                                <input type="text" class="form-control pl-3" name="guard_name" placeholder="Guard Name" id="name">
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