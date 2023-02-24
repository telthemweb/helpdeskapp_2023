<div class="container-fluid px-xl-5 mt-lg-5">
	<div class="row mb-3">
		<div class="col-lg-12 col-md-12">
			<div id="switchPoint" class="e-panel card">
				<div class="card-header bg-brown">Penalty Information <b class="float-right"></b></div>
				<div class="card-body">
					<div class="card-title">
				    <h6 class="mr-2"><span><?php echo "<b class='text-info'>COMPANY NAME </b> :   ". strtoupper($penalty->company->name); ?> </span></h6><hr>
				</div><br>
				<div class="row">
					<div class="col-md-2">
						<img style="border-radius: 0%!important;" src="<?php echo url('assets/img/done.png'); ?>" width="123px" alt="<?php echo $penalty->comment;?>">

					</div>
					<div class="col-md-8">
						<p><?php echo $penalty->comment;?></p>

						<small class="text-left text-red">Penalty is hereby charge to the task that your company did not meet. So your company is going to pay delay fee of <b>$50</b> to <?php echo $penalty->company->name;?>.Now click <b>Accept button</b> to Pay</small><br>
						<?php if($penalty->administrator_id==null): ?>
						<a class="btn btn-danger float-right rounded-0" href="<?php route('/technician/t/'.$penalty->id) ?>">
						Reject Penalty <i class="fa fa-times-circle mr-2"></i></a>
						<a class="btn btn-success float-right rounded-0" href="<?php route('/penalty/accept/'.$penalty->id) ?>">
						Accept Penalty <i class="fa fa-check-circle mr-2"></i></a>
					<?php else: ?>
						<b class="badge badge-success float-right rounded-0 p-2">
						Paid <i class="fa fa-check-circle mr-2 "></i></b>
					<?php endif;?>
					</div>
					<div class="col-md-2">
						 
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>