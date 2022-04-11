<?php
    if(!defined("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^")){
        header("location:../index.php");
        die();
    }
?>
<div class="continer_nav">
    <nav class="navCus">
        <input type="checkbox" id="check" class="check_btn_par noDis">
        <label for="check" class="check_btn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo">Loan Garage</label>
        <ul class="ulCus">
            <li class="liCus"><a class="aCus home" href="./index.php">Home</a></li>
            <li class="liCus"><a class="aCus loan_apply" href="./loan_apply.php">Loan Apply</a></li>
            <li class="liCus"><a class="aCus emi_calc" href="./emicalc.php">Emi Calculator</a></li>
            <li class="liCus"><a class="aCus join_patner" href="./join-affilite.php">Join as Partner</a></li>
            <li class="liCus"><a class="aCus login" href="./partner_auth.php">Partner Login</a></li>
            <!--<li class="liCus"><a class="aCus find_ifsc" href="./find_ifsc.php">Find ifsc</a></li>-->
        </ul>
    </nav>
</div>
<script>
        var check_menu=document.getElementById("check");
        var body=document.body;
        check_menu.addEventListener("change",()=>{
            if(check_menu.checked==true){
                body.style.height="100vh";
                body.style.overflow="hidden"
            }else{
                body.style.height="auto";
                body.style.overflow="auto"
            }
        })
</script>