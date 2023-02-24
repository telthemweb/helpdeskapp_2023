<div class="container-fluid px-xl-5 mt-lg-5">

    <div class="container user-list">
        <div class="row flex-lg-nowrap mb-5">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">REPORT FOR PAYMENTS</b>  </span><small class="px-1 float-lg-right"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-left">#RefNo</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Day</th>
                                        <th class="text-center">Month</th>
                                        <th class="max-width">Amount</th>
                                        <th class="max-width">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($payments)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($payments as $trans): $i++; ?>
                                            <tr>
                                            
                                                <td class="text-left"><?php echo $trans->paymentnumber  ?></td>
                                                <td class="text-center"><?php echo date('d',strtotime($trans->created_at)) ; ?></td>
                                                <td class="text-center"><?php echo date('D',strtotime($trans->created_at)) ; ?></td>
                                                <td class="text-center"><?php echo date('M',strtotime($trans->created_at)) ; ?></td>
                                                <td class="text-center"><?php echo $trans->amount_paid ; ?></td>
                                                <td><?php echo date('d-M-Y',strtotime($trans->created_at)) ; ?></td>
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="10" class="text-danger text-center"><b>No Payments found</b></td>
                                        <?php endif; ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right badge badge-dark p-4"><b>Total</b><span class="ml-5"><strong><?php echo "$". $payments->sum('amount_paid')?></strong></span></div>
                       
                    </div> 
                </div>
            </div>
        </div>

       
    </div>
</div>
