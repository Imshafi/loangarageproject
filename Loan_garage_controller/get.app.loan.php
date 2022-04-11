<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(isset($_SESSION['ADMIN_LOGIN_STATUS']) AND isset($_SESSION['ADMIN_ID'])        AND 
    !empty($_SESSION['ADMIN_LOGIN_STATUS'])   AND !empty($_SESSION['ADMIN_ID'])       AND
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])  AND is_numeric($_SESSION['ADMIN_ID'])   AND
    $_SESSION['ADMIN_LOGIN_STATUS']===true    AND $_SESSION['ADMIN_ID']==1){
        define("A0(57%?<Fr@4**&__APPLICATIONS___K#2*&(J^8392$()8347&^",true);
        echo "<script>var status_app=0</script>";
        require_once 'ui.loan.partner.app.php';
    }
    else
    {
        header("location:admin_home.php");
        die();
    }
?>