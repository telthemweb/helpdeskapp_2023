<script src="<?php echo url('assets/libs/js/jquery-3.5.1.min.js'); ?>"></script>

<script src="<?php echo url('assets/libs/js/popper.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo url('js/slimscroll.min.js'); ?>"></script>


<script src="<?php echo url('assets/libs/js/select2.min.js'); ?>"></script>
<script src="<?php echo url('jassets/libs/js/app.js'); ?>"></script>
<?php if ($sess->getFlash('success')): ?>
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
                text:'<?php echo $sess->getFlash('success') ?>'
            })
        </script>
    <?php elseif ($sess->getFlash('error')): ?>
        <script type="text/javascript">
            Swal.fire({
                toast: true,
                animation: false,
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-right',
                timer: 3000,
                icon:'error',
                background:'red',
                color:'white',
                title:'Error Message',
                text:'<?php echo $sess->getFlash('error') ?>'
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
</script>

</body>
</html>

</body>
</html>