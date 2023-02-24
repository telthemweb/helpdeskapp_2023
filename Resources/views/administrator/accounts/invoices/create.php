<div class="container-fluid mt-lg-5 px-xl-5">
        <div class="row justify-content-center mb-lg-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-white">CREATE INVOICE FOR <?php echo strtoupper($task->ticket->title); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="py-1">
                            <form  action="<?php route('/invoice/register') ?>" method="POST">
                            <input type="hidden" name="_crsftoken" value="<?php CSRFToken(); ?>">
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                            <label for="">Price</label>
                                            <input type="text" class="form-control pl-3" name="price" id="price" placeholder="Price per hour" required="required">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="rounded">
                                            <label for="">Quantity</label>
                                            <input type="number" class="form-control pl-3" name="qty" id="qty" placeholder="Quantity"
                                                required="required" value="1">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                        <label for="">Discount Percentage</label>
                                            <input type="text" class="form-control pl-3" name="discountperc" placeholder="Discount Percentage" value="0.0" required="required" id="discountperc" onchange="getdiscountperc()">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="rounded">
                                                <label for="">Discount Amount</label>
                                                <input type="text" class="form-control pl-3" name="discountamount" placeholder="Discount Amount"
                                                    required="required"  id="discountamount">
                                                    <input type="hidden" class="form-control pl-3" name="task_id" value="<?php echo $task->id?>" required="required"  >
                                            </div>
                                        </div>
                                        </div>
                                   
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                        <label for="">VAT Percentage</label>
                                            <input type="text" class="form-control pl-3" name="tax_perc" value="0.0" placeholder="VAT Percentage"  required="required" id="tax_perc" onchange="getVatperc(),calculateGrossTotal(),calculateNetTotal()">
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                            <label for="">VAT Amount</label>
                                            <input type="text" class="form-control pl-3" name="taxamount" placeholder="Tax Amount"
                                                required="required" readonly id="taxamount"  >
                                        </div>
                                    </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                        <label for="">Comment</label>
                                            <input type="text" class="form-control pl-3" name="invoice_note" placeholder="Comment"
                                                required="required" id="invoice_note">
                                        </div>
                                    </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                            <label for="">Invoice Due Date</label>
                                            <input type="date" class="form-control pl-3" name="invoice_due_date" required="required"  id="invoice_due_date" value="0.0">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                            <input type="hidden" class="form-control pl-3" name="sub_total" required="required"  id="hsubtotal" value="0.0">
                                            <input type="hidden" class="form-control pl-3" name="company_id"   id="company_id" value="<?php echo $company_id ?>">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <div class="rounded">
                                            <input type="hidden" class="form-control pl-3" name="total_amt" required="required"  id="htotal" value="0.0">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div><br><br>
                                <hr><br>
                                <div class="row mb-4">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-5">
                                    <div class="float-lg-right">
                                       <b>Discount Percentage       <b class="float-right ml-5" id="inv_discperc"></b></b><hr>
                                       <b>Discount Amount  <b class="float-right ml-5" id="inv_disamount"></b></b><hr>
                                       <b>Tax Percentage <b class="float-right ml-5" id="inv_taxperc"></b></b><hr>
                                       <b>Tax Amount <b class="float-right ml-5" id="inv_taxamount"></b></b><hr>
                                       <b>SubTotal <b class="float-right ml-5" id="inv_subtotal"></b></b><hr>

                                       <b>Total to be paid <b class="float-right ml-5" id="inv_total"></b></b><hr>
                                       <hr>
                                    </div>   
                                    </div>

                                </div>
                                <div class="float-lg-right">
                                    <div class="">
                                        <button type="submit" class="btn btn-danger btn-lg"  id="clientreg" >SUBMIT</button>
                                    </div>
                                
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
