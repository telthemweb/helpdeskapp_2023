
<div class="container-fluid px-xl-5 mt-lg-5">
<div class="row mb-3">
<div class="col-md-12">



</div>
</div>
        
        <?php if($_SESSION['role_Id']=="1" || $_SESSION['role_Id']=="2") : ?>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card shadow-sm bg-info">
                    <a href="<?php route('/employees'); ?>">
                        <div class="card-body">
                            <b class="text-white"><i class="fa fa-users mr-3 text-white">
                                </i>EMPLOYEES  <b class="badge badge-danger rounded p-lg-2 float-lg-right"><?php echo $employeesCount==null?'0':$employeesCount; ?></b></b>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-secondary">
                    <a href="<?php route('/companies'); ?>">
                        <div class="card-body">
                            <b class="text-white"><i class="fa fa-users mr-3 text-white">
                                </i>COMPANIES<b class="badge badge-danger rounded p-lg-2 float-lg-right"><?php echo $customersCount==null?'0':$customersCount; ?></b></b>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm bg-outline">
                    <a href="<?php route('/tickets'); ?>">
                        <div class="card-body">
                            <b class="text-dark"><i class="fa fa-comment-dots mr-3 text-dark">
                                </i>TICKETS<b class="badge badge-danger rounded p-lg-2 float-lg-right"><?php echo $totalticket==null?'0':$totalticket; ?></b></b>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card shadow-sm bg-info">
                    <a href="<?php route('/invoices'); ?>">
                        <div class="card-body">
                            <b class="text-white"><i class="fa fa-users mr-3 text-white">
                                </i>TOTAL INVOICE  <b class="badge badge-danger rounded p-lg-2 float-lg-right"><?php echo 'USD$'. $invoicessum==null?'0':'USD$'. $invoicessum; ?></b></b>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm bg-info">
                    <a href="<?php route('/payments'); ?>">
                        <div class="card-body">
                            <b class="text-white"><i class="fa fa-file-alt mr-3 text-white">
                                </i>TOTAL PAYMENTS <b class="badge badge-danger rounded p-lg-2 float-lg-right"><?php echo 'USD$'. $fullpayment==null?'0':'USD$'.$fullpayment; ?></b></b>
                        </div>
                    </a>
                </div>
            </div>
        </div>
       
        <div class="row mb-3">
            <div class="col-md-4">
            <div class="card shadow-sm rounded-0 bg-success">
            <div class="card-header  rounded-0 text-dark"><strong>Pending Invoice</strong> <i class="fa fa-copy mr-3 text-dark float-lg-right"></i></div>
            <div class="card-body"><i class="fa fa-copy mr-3 text-white"></i><b class="ml-4 text-white">USD $<?php echo $invoicespendingsum; ?></b></div>
            </div>
            </div>
          
            <div class="col-md-4">
            <div class="card shadow-sm rounded-0 bg-danger">
            <div class="card-header  rounded-0 text-dark"><strong>Penalties</strong> <i class="fa fa-copy mr-3 text-dark float-lg-right"></i></div>
            <div class="card-body bg-danger"><b class="ml-4 text-white">USD $<?php echo $penaltcout; ?></b></div>
            </div>
            </div>
        </div>

    <?php elseif($_SESSION['role_Id']=="3"): ?>
        <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">Completed Tasks: </b> </span></h6>
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
                                                 <td><?php echo $tas->status; ?> </td>
                                            <td class="text-center">
                                                <a class="text-success"  href="<?php route('/technician/v/'.$tas->task->id) ?>" >
                                                  <i class="fa fa-eye mr-3 text-success"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <?php else: ?>
                                        <td colspan="7" class="text-danger text-center"><b>No Completed Task yet!!!</b></td>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
       </div>
    </div>
</div>
<?php endif; ?>