<div class="container-fluid px-xl-5 mt-lg-5">

    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">RECEIPTS</b>  </span><small class="px-1 float-lg-right"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Receiptnumber</th>
                                        <th class="text-center">Amount</th>
                                        <th class="max-width">Invoice</th>
                                        <th class="max-width">Source</th>
                                        <th class="max-width">Company</th>
                                        <th class="text-center">Status</th>
                                        <th class="max-width">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($receipts)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($receipts as $trans): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $trans->receiptnumber; ?></td>
                                                <td><?php echo $trans->amount ; ?></td>
                                                <td><?php echo $trans->invoice->invoicenumber; ?></td>
                                                <td><?php echo $trans->paymentmode ; ?></td>
                                                <td><?php echo $trans->company->name ; ?></td>
                                                <td><?php echo $trans->status ; ?></td>
                                                <td><?php echo date('d-M-Y',strtotime($trans->created_at)) ; ?></td>
                                               
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="10" class="text-danger text-center"><b>No Receipts found</b></td>
                                        <?php endif; ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right badge badge-dark p-4"><b>Gross Total</b><span class="ml-5"><strong><?php echo "$". $receipts->sum('amount')?></strong></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
