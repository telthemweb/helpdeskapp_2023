<div class="container-fluid px-xl-5 mt-lg-5">

    <div class="container user-list">
        <div class="row flex-lg-nowrap">
            <div class="col-lg-12">
                <div id="switchPoint" class="e-panel card">
                    <div class="card-body">
                        <div class="card-title">
                            <h6 class="mr-2"><span><b class="text-info">INVOICES</b>  </span><small class="px-1 float-lg-right"></small></h6>
                        </div>
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                <table class="table table-bordered" id="myTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Invoice Number</th>
                                        <th class="max-width">Amount</th>
                                        <th class="max-width">Due Date</th>
                                        <th class="max-width">Company</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody id="role">
                                        <?php  if(count($invoices)>0): ?>
                                        <?php
                                        $i =0; ?>
                                        <?php foreach ($invoices as $trans): $i++; ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i ?></td>
                                                <td><?php echo $trans->invoicenumber; ?></td>
                                                <td><?php echo $trans->total_amt ; ?></td>
                                                <td><?php echo date('d-M-Y',strtotime($trans->invoice_due_date)) ; ?></td>
                                                <td><?php echo $trans->company->name ; ?></td>
                                                <td><?php echo $trans->invoice_status ; ?></td>
                                                <td class="text-center">
                                                <a class="text-success"  href="<?php route('/invoice/edit/'.$trans->id) ?>"" ><i class="fa fa-edit mr-3 text-green"></i></a>
                                                <a class="text-danger"  href="#" ><i class="fa fa-trash mr-3 text-danger"></i></a>
                                                <a class="text-info"  href="<?php route('/invoice/v/'.$trans->id) ?>" ><i class="fa fa-file mr-3 text-info"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td colspan="3" class="text-danger text-center"><b>No Invoices found</b></td>
                                        <?php endif; ?>
                                        </tbody>
                                 </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right badge badge-dark p-4"><b>Gross Total</b><span class="ml-5"><strong><?php echo "$". $invoices->sum('total_amt')?></strong></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
