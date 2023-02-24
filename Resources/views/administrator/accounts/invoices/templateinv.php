
<div id="page">
	
<?php if($invoice->invoice_status=="Not Paid"):?>
    <div class="status sent">
		<p>Paid</p>
	</div>
    <?php elseif($invoice->invoice_status=="Overdue"):?>
    <div class="status overdue">
		<p>Paid</p>
	</div>
    <?php else: ?>
    <div class="status paid">
		<p>Paid</p>
	</div>
	<?php endif;?>	
		
	<p class="recipient-address">
	<strong><?php echo $ticket->company->name;?> Address</strong><br />
	<?php echo $ticket->company->address;?><br />
	<?php echo $ticket->company->city;?><br /></p>
	
	<h6>Invoice <?php echo "#".$invoice->invoicenumber; ?></h6>
	<p class="terms mb-4"><strong><?php echo 'Craeted Date: '. date('d-M-Y',strtotime($invoice->created_at)) ; ?></strong><br/>
	<b class="text-danger">
     <strong>Payment due by  <?php echo date('d-M-Y',strtotime($invoice->invoice_due_date)) ; ?></strong>
    </b></p>
	
	<img src="<?php echo url('assets/img/favicon.ico'); ?>" alt="yourlogo" class="company-logo"  width="90px"/>
	<p class="company-address">
		Riverbird Technologies<br/>
		234 Harare<br/><br/>
	</p>
	
	<table id="table" class="tablesorter table table-bordered" cellspacing="0"> 
	<thead> 
	<tr> 
	    <th>Quantity</th> 
	    <th>Description</th> 
	    <th>Unit Price</th> 
	</tr> 
	</thead> 
	<tbody> 
	
	
	<tr> 
	    <td><?php echo $invoice->qty; ?></td> 
	    <td><?php echo $ticket->title; ?></td> 
	    <td>$<?php echo $invoice->price; ?></td> 
	</tr> 
	</tbody> 
	</table> 
	<div class="row mb-4">
                <div class="col-md-6"></div>
                <div class="col-md-5">
                <div class="float-lg-right">
                    <b>Discount Percentage       <b class="float-right ml-5" id="inv_discperc"><?php echo $invoice->discountperc*100; ?>%</b></b><hr>
                    <b>Discount Amount  <b class="float-right ml-5" id="inv_disamount">$<?php echo $invoice->discountamount; ?></b></b><hr>
                    <b>Tax Percentage <b class="float-right ml-5" id="inv_taxperc"><?php echo $invoice->tax_perc*100; ?>%</b></b><hr>
                    <b>Tax Amount <b class="float-right ml-5" id="inv_taxamount">$<?php echo $invoice->taxamount; ?></b></b><hr>
                    <b>SubTotal <b class="float-right ml-5" id="inv_subtotal">$<?php echo $invoice->sub_total; ?></b></b><hr>

                    <b class="text-success">AMOUNT DUE <strong class="float-right ml-5" id="inv_total">$<?php echo $invoice->total_amt; ?></strong></b><hr>
                    </div>   
                </div>
               
	
	
	<hr /><br>
<p>#code <?php echo md5('innocent Tauzeni') ?></p><br/>
	
</div>
