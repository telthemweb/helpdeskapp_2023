<script src="<?php echo url('assets/libs/js/jquery.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/jquery-migrate-3.0.1.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/popper.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/jquery.cookie/jquery.cookie.js'); ?>"> </script>
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
<script src="<?php echo url('assets/libs/js/jquery.datatables.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/datatables.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/Chart/Chart.min.js'); ?>"></script>
<script src="<?php echo url('assets/libs/js/sweetalert2.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myTable").DataTable()
    });
</script>
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
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-right',
                timer: 3000,
                icon:'error',
                background:'red',
                color:'white',
                title:'Error Message',
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

    function calculate(){
        
        var discountperc= document.getElementById("discountperc").value;
        var discountamount= document.getElementById("discountamount").value;
        var tax_perc= document.getElementById("tax_perc").value;
        var taxamount= document.getElementById("taxamount").value;
        var sub_total= document.getElementById("sub_total").value;
        var total_amt= document.getElementById("total_amt").value;

        var inv_discperc= document.getElementById("inv_discperc")
        var inv_disamount= document.getElementById("inv_disamount")
        var inv_taxperc= document.getElementById("inv_taxperc")
        var inv_taxamount= document.getElementById("inv_taxamount")
        var inv_subtotal= document.getElementById("inv_subtotal")
        var inv_total= document.getElementById("inv_total")

    }

    function getdiscountperc(){
        var discountperc= document.getElementById("discountperc").value;
        var discountamount= document.getElementById("discountamount")
        var inv_disamount= document.getElementById("inv_disamount")
        inv_discperc.innerHTML=Number(discountperc)*100 +"%"
        var price=document.getElementById("price").value;
        var qty=document.getElementById("qty").value;
        var t =price*qty
        discountamount.value=discountperc*t
        inv_disamount.innerHTML="$"+ discountperc*t
    }
    function getVatperc(){
        var tax_perc= document.getElementById("tax_perc").value;
        var taxamount= document.getElementById("taxamount");
        inv_taxperc.innerHTML=Number(tax_perc)*100 +"%"
        var price=document.getElementById("price").value;
        var qty=document.getElementById("qty").value;
        var inv_taxamount= document.getElementById("inv_taxamount")
        var t =price*qty
        taxamount.value=tax_perc*t
        inv_taxamount.innerHTML="$"+ tax_perc*t
    }
    function calculateTotal(){
        var price=document.getElementById("price").value;
        var qty=document.getElementById("qty").value;
        var inv_total= document.getElementById("inv_total")
        inv_total.innerHTML = price *qty;
    }
    function calculateGrossTotal(){
        var taxamount= document.getElementById("taxamount").value;
        var discountamount= document.getElementById("discountamount").value;
        var price=document.getElementById("price").value;
        var qty=document.getElementById("qty").value;
        var total =price*qty
        var inv_subtotal= document.getElementById("inv_subtotal")
        var hsubtotal= document.getElementById("hsubtotal")
        hsubtotal.value=total+Number(taxamount)+Number(discountamount);
        inv_subtotal.innerHTML =total+Number(taxamount)+Number(discountamount);
    }
    function calculateNetTotal(){
        var taxamount= document.getElementById("taxamount").value;
        var discountamount= document.getElementById("discountamount").value;

        //alert(typeof())
        var htotal= document.getElementById("htotal")

        var price=document.getElementById("price").value;
        var qty=document.getElementById("qty").value;
        var inv_total= document.getElementById("inv_total")
        var tot =price*qty
        var newtotal=tot - Number(discountamount);
        var finaltotal= newtotal+Number(taxamount);
        htotal.value=finaltotal
        

        

         inv_total.innerHTML ="$"+ finaltotal;

        
        //var inv_total= document.getElementById("inv_total")
    }



</script>

</body>
</html>
