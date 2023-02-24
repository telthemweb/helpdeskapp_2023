





<footer class="ftco-footer" id="basic-footer">
    <div class="container-fluid bg-primary py-5">
        <div class="row">
            <div class="col-md-12 text-center">

                <p class="mb-0">
                    Copyright Riverbird Techologies &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
                </p>
            </div>
        </div>
    </div>
</footer>


<script src="<?php echo url('assets/libs/js/jquery.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/popper.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/jquery.easing.1.3.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/jquery.waypoints.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/jquery.stellar.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/owl.carousel.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/jquery.magnific-popup.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/jquery.animateNumber.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/bootstrap-datepicker.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/jquery.timepicker.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/scrollax.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/all.min.js'); ?>"></script>
 <script src="<?php echo url('assets/libs/js/sweetalert2.js'); ?>"></script>
<?php if ($session->getFlash('success')): ?>
        <script type="text/javascript">
            Swal.fire({
                toast: true,
                animation: false,
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-right',
                timer: 3000,
                icon:'success',
                background:'green',
                color:'white',
                title:'Success Message',
                text:'<?php echo $session->getFlash('success') ?>'
            })
        </script>
    <?php elseif ($session->getFlash('error')): ?>
        <script type="text/javascript">
            Swal.fire({
                toast: true,
                animation: false,
                position: 'top-right',
                timer: 3000,
                icon:'error',
                background:'red',
                color:'white',
                title:'Error Message',
                showConfirmButton: false,
                timerProgressBar: true,
                text:'<?php echo $session->getFlash('error') ?>'
            })
        </script>
    <?php endif; ?>
<script>
    function showPass(){
        var x = document.getElementById("password");
        if(x.type === "password"){
            x.type = "text";
        }else{
            x.type="password";
        }
    }
    // toast: true,
    // icon: 'success',
    // title: 'Posted successfully',
    // animation: false,
    // position: 'bottom',
    // showConfirmButton: false,
    // timer: 3000,
    // timerProgressBar: true,

</script>

</body>
</html>

</body>
</html>
