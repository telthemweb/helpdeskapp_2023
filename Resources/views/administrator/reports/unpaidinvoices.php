<div class="container-fluid px-xl-5 mt-lg-5">

    <div class="container user-list">
         <div class="row flex-lg-nowrap mb-5">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">REPORT FOR NOT PAID INVOICES</b>  </span><small class="px-1 float-lg-right mb-5"> </small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="max-width">Month</th>
                                        <th class="text-left">Invoice Number</th>
                                        <th class="max-width">Amount</th>
                                        <th class="max-width">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($invoices)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($invoices as $trans): $i++; ?>
                                            <tr>
                                            
                                                <td><?php echo date('M',strtotime($trans->created_at)) ; ?></td>
                                                <td class="text-left"><?php echo $trans->invoicenumber  ?></td>
                                                
                                                
                                                <td><?php echo $trans->total_amt ; ?></td>
                                                <td><?php echo $trans->invoice_status ; ?></td>
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="10" class="text-danger text-center"><b>No Unpaid Invoice report found</b></td>
                                        <?php endif; ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                     <div class="card-footer">
                        <div class="float-right badge badge-dark p-4"><b>Total</b><span class="ml-5"><strong><?php echo "$". $invoices->sum('total_amt')?></strong></span></div>
                       
                    </div> 
                    
                </div>
            </div>
        </div>

       
    </div>
</div>
