<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}
if( isset( $_POST ) AND !empty( $_POST ) AND isset( $_POST['response'] ) AND isset( $_POST['loan_id'] ) AND !empty( $_POST['response'] ) AND !empty( $_POST['loan_id'] ) AND isset( $_POST['type'] ) AND ( $_POST['type']==0 || $_POST['type']==2 ) ){
    if(isset($_SESSION['LOAN_RESPONSE_ADMIN']) AND !empty($_SESSION['LOAN_RESPONSE_ADMIN']) AND $_SESSION['LOAN_RESPONSE_ADMIN']!==0){
        if(isset($_POST['LOAN_RESPONSE_ADMIN']) AND !empty($_POST['LOAN_RESPONSE_ADMIN']) AND $_POST['LOAN_RESPONSE_ADMIN']!==0){
            if($_POST['LOAN_RESPONSE_ADMIN']==$_SESSION['LOAN_RESPONSE_ADMIN']){
                require_once '../all.min.sub.php.dir/connection.all.min.php';
                require_once '../all.min.sub.php.dir/send_mail.php';
                $response=xss_val($con,$_POST['response']);
                $loan_id=xss_val($con,$_POST['loan_id']);
                $status=xss_val($con,$_POST['type']);
                $stmt_update=mysqli_prepare($con,"UPDATE `loan_apply_form` SET `status_loan`=?,`response`=? WHERE `id`=? AND `email_confrim`=? AND `mobile_confrim`=?");
                if($stmt_update){
                    $confrim=0;
                    mysqli_stmt_bind_param($stmt_update,"isiii",$status,$response,$loan_id,$confrim,$confrim);
                    $exe=mysqli_stmt_execute($stmt_update);
                    $aff=mysqli_stmt_affected_rows( $stmt_update );
                    mysqli_stmt_close( $stmt_update );
                    if( $exe==1 && $aff==1 ){
                        $stmt_get=mysqli_prepare($con,"SELECT `email` FROM `loan_apply_form` WHERE `id`=?");
                        if( $stmt_get )
                        {
                            mysqli_stmt_bind_param       ( $stmt_get,"i",$loan_id );
                            mysqli_stmt_bind_result      ( $stmt_get,$loan_email );
                            $exe_get=mysqli_stmt_execute ( $stmt_get );
                            $fet_get=mysqli_stmt_fetch   ( $stmt_get );
                            mysqli_stmt_close            ( $stmt_get );
                            if( $exe_get && $fet_get && !empty( $loan_email ) )
                            {


                                if($status==0){
                                    $ret="Accepted";
                                }else{
                                    $ret="Rejected";
                                }
                                if( send_mail($loan_email,"Requested Loan ".$ret,$response ) )
                                {
                                    unset( $_SESSION['LOAN_RESPONSE_ADMIN'] );
                                    return_status("success","Loan Successfully $ret.");
                                }
                                else
                                {
                                    return_status("success","Loan Successfully ".$ret." But Unable to send mail");
                                }
                            }
                            else
                            {
                                return_status("failed","Unable to get loan data");
                            }
                        }
                        else
                        {
                            return_status("failed","Something went wrong");
                        }
                    }else{
                        return_status("failed","Failed To Update Loan Status");
                    }
                }else{
                    return_status("failed","Failed To Create Object");
                }
            }else{
                return_status("failed","Token Mismatch Please Reload Page");
            }
        }else{
            return_status("failed","Token Missing Please Reload Page");
        }
    }else{
        return_status("failed","Token Missing Please Reload Page");
    }
}else{
    header("location:../partner_auth.php");
    die();
}
function return_status($status,$data){
    echo json_encode(['status'=>$status,'data'=>$data]);
}
?>