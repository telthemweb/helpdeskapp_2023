<script src="<?php echo url('assets/libs/js/jquery.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/tablesorter.js'); ?>"></script>
<script type="text/javascript">
	  $(document).ready(function() 
	      { 
	          $("#table").tablesorter({ 
	      widgets: ['zebra'] 
	      }); 
	      } 
	  ); 
	  </script>
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
