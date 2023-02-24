<div class="container-fluid px-xl-5 mt-lg-5">
    
    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">Latest Tasks: </b> </span></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Task</th>
                                        <th class="max-width">Start</th>
                                        <th class="max-width">End</th>
                                        <th class="max-width">Priority</th>
                                        <th class="max-width">Status</th>
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
                                            <td class="text-left"><?php echo $tas->task->taskcomment ?></td>
                                            <td><?php echo date('d-M-Y',strtotime($tas->task->task_date)); ?></td> 
                                            <td><?php echo date('d-M-Y',strtotime($tas->task->task_end)); ?> </td>
                                            <?php if($tas->task->prioritType=="Extremely"): ?>
                                            <td class="text-left"><b class="text-center text-danger">Emergence  <i class="fa fa-fire mr-3 text-danger"></i></b></td>
                                            <?php else: ?>
                                                <td class="text-left"><?php echo $tas->task->prioritType ?></td>
                                                <?php endif; ?>
                                                 <td><?php echo date('d-M-Y',strtotime($tas->status)); ?> </td>
                                            <td class="text-center">
                                                <a class="text-success"  href="<?php route('/technician/v/'.$tas->task->id) ?>" >
                                                  <i class="fa fa-eye mr-3 text-success"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <?php else: ?>
                                        <td colspan="7" class="text-danger text-center"><b>Sorry this tasks not yet assignedd to any Technician</b></td>
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