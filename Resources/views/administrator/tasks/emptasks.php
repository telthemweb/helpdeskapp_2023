<div class="container-fluid px-xl-5 mt-lg-5">
    <button class="btn btn-success float-right rounded-0"  data-toggle="modal" data-target="#user-form-modal">
        Assign Technician <i class="fa fa-folder"></i>
    </button>
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">Technician's Tasks: </b> <?php echo strtoupper($task->ticket->title); ?> </span><small class="px-1 float-lg-right"><?php echo "<b>Task Ref Number</b>   #". $task->taskcode; ?></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="max-width">Assigned to</th>
                                        <th class="max-width">Start</th>
                                        <th class="max-width">End</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                    <?php  if(count($admins)>0): ?>
                                    <?php
                                    $i =0; ?>
                                    <?php foreach ($admins as $tas): $i++; ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i ?></td>
                                            <td><?php echo $tas->administrator->name.' '.$tas->administrator->surname; ?></td>
                                            <td><?php echo date('d-M-Y',strtotime($tas->task->task_date)); ?></td> 
                                            <td><?php echo date('d-M-Y',strtotime($tas->task->task_end)); ?> </td>
                                            <td class="text-center">
                                                <a class="text-danger"  href="<?php route('/task/r/'.$tas->id.'/'.$tas->administrator_id); ?>" >
                                                  <i class="fa fa-trash mr-3 text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <?php else: ?>
                                        <td colspan="6" class="text-danger text-center"><b>Sorry this tasks not yet assignedd to any Technician</b></td>
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
                <h5 class="modal-title text-white">ASSIGN TECHNICIAN</h5>
                <button  class="close text-white" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php route('/task/assign'); ?>" method="POST">
                        <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                        <div class="form-group">
                        <select class="form-control" name="administrator_id" id="administrator_id">
                                <option value="" disabled selected>Select Technician</option>
                                <?php foreach ($administrators as $admin){?>
                                    <option value="<?php echo $admin->id; ?>"><?php echo $admin->name.' '.$admin->surname; ?></option>
                                <?php }?>
                             </select>
                             <input type="hidden"  name="task_id"  value="<?php echo $task->id ?>">
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