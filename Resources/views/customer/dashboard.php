<div class="container mt-lg-5 mb-lg-5">
<div class="row">
    <div class="col-md-8">
    <div class="py-1">
        <h3>Hi <?php echo $_SESSION['name']; ?> </h3>
        <p class="section-content-text  mx-auto">
            We have provided quality technical support to many companies.<br>
            <a href="<?php route('/company/support')?>" class="btn btn-primary">Create Ticket</a>
         </p>
        </div>
    </div>
    <div class="col-md-4">
    <div class="py-1">
    <img src="<?php echo url('assets/img/favicon.ico'); ?>">
    </div>
    </div>
</div>
</div>