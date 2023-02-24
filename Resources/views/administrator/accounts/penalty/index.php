<div class="container-fluid px-xl-5 mt-lg-5">

    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">PENALTIES</b>  </span><small class="px-1 float-lg-right"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="max-width">Company</th>
                                        <th class="max-width">Comment</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($penalties)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($penalties as $trans): $i++; ?>
                                            <tr>
                                                <td><?php echo $trans->company->name ; ?></td>
                                                <td><?php echo $trans->comment ; ?></td>
                                                <td><?php echo date('d-M-Y',strtotime($trans->created_at)) ; ?></td>
                                                <td class="text-center">
                                                 <a class="text-info"  href="<?php route('/penalty/v/'.$trans->id) ?>" ><i class="fa fa-eye mr-3 text-info"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="3" class="text-danger text-center"><b>No Penalty found</b></td>
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
