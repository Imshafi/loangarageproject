<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}

if ( check( $_POST['token'] ) && check( $_POST['uid'] ) &&  check( $_POST['amt'] ) && is_numeric( $_POST['uid'] ) && is_numeric( $_POST['amt'] ) ) 
{
    if( check( $_SESSION['GET_PARTNER_WORKING'] ) && $_SESSION['GET_PARTNER_WORKING']==$_POST['token'] )
    {
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $amt=xss_val( $con,$_POST['amt'] );
        $uid=xss_val( $con,$_POST['uid'] );
        $sta=0;
        $stmt=mysqli_prepare( $con,"UPDATE `refer_loan` SET `dabbu`=? WHERE `id`=? AND `refer_status`=? " );
        if( $stmt )
        {
            mysqli_stmt_bind_param( $stmt,"iii",$amt,$uid,$sta );
            $exe=mysqli_stmt_execute( $stmt );
            $aff=mysqli_stmt_affected_rows( $stmt );
            if( $aff && $exe )
            {
                rtn("success","success");
            }
            else
            {
                rtn("failed","Something went wrong");
            }
        }
        else
        {
            rtn("failed","Something went wrong");
        }    
    }
    else
    {
        rtn("failed","Please reload the page");
    }
}
else
{
    header("location:index.php");
}

function check( $val )
{
    return ( isset( $val ) && !empty( $val ) );
}

function rtn($status,$data)
{
    echo json_encode( ['status'=>$status,'data'=>$data] );
}


?>