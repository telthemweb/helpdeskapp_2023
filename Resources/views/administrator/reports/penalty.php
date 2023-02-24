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
                                        <th class="max-width">Month</th>
                                        <th class="max-width">Year</th>
                                        <th class="max-width">Rate</th>
                                        <th class="max-width">Number of Days</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($penalties)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($penalties as $trans): $i++; ?>
                                            <tr>
                                                <td><?php echo date('M',strtotime($trans->created_at)) ; ?></td>
                                                <td><?php echo date('Y',strtotime($trans->created_at)) ; ?></td>   
                                                  <td class="text-center"><?php echo $trans->rate ; ?></td>                                         
                                                  <td class="text-center"><?php echo $trans->numb_hours ; ?></td>                                         
                                                  <td class="text-center"><?php echo $trans->rate*$trans->numb_hours ; ?></td>                                         
                                            
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="5" class="text-danger text-center"><b>No Penalty found</b></td>
                                        <?php endif; ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right badge badge-dark p-4"><b>Total Rates</b><span class="ml-5"><strong><?php echo "$". $penalties->sum('rate') ?></strong></span></div>
                       
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>