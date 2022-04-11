<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}
if( isset( $_POST['token'] ) && !empty( $_POST['token'] ) && isset( $_POST['type'] ) && is_string( $_POST['type'] ) )
{
    if( isset( $_SESSION['COUNT_TOKEN'] ) && !empty( $_SESSION['COUNT_TOKEN'] ) && $_POST['token']==$_SESSION['COUNT_TOKEN'] )
    {
        if( $_POST['type']=="all_loan" )
        {
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="loan_apply_form";
            $email="email_confrim";
            $mobile="mobile_confrim";
            return count_all($table_name,$mobile,$email,$con);
            die();
        }elseif( $_POST['type']=="all_partner" ){

            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="form_information_submitted";
            $email="email_verify";
            $mobile="mobile_verify";
            return count_all($table_name,$mobile,$email,$con);
            die();

        }elseif( $_POST['type']=="app_loan" )
        {
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="loan_apply_form";
            $email="email_confrim";
            $mobile="mobile_confrim";
            $status=0;
            $status_table="status_loan";
            return count_data($table_name,$mobile,$email,$status_table,$status,$con);
            die();

        }elseif( $_POST['type']=="rej_loan" )
        {
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="loan_apply_form";
            $email="email_confrim";
            $mobile="mobile_confrim";
            $status=2;
            $status_table="status_loan";
            return count_data($table_name,$mobile,$email,$status_table,$status,$con);
            die();

        }elseif( $_POST['type']=="app_partner" )
        {
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="form_information_submitted";
            $email="email_verify";
            $mobile="mobile_verify";
            $status=0;
            $status_table="status";
            return count_data($table_name,$mobile,$email,$status_table,$status,$con);
            die();

        }
        elseif( $_POST['type']=="rej_partner" )
        {
            require_once '../all.min.sub.php.dir/connection.all.min.php';
            $table_name="form_information_submitted";
            $email="email_verify";
            $mobile="mobile_verify";
            $status=2;
            $status_table="status";
            return count_data($table_name,$mobile,$email,$status_table,$status,$con);
            die();

        }else{
            return_data('failed',"Something went wrong..");
            die();
        }
    }
    else
    {
        return_data('failed',"Session error please reload page");
    }
}
else
{
    header("location:index.php");
    die();
}

function return_data($status,$data)
{
    echo json_encode( ['status'=>$status,'data'=>$data] );
}

function count_data($table_name,$mobile,$email,$status_table,$status,$con)
{
    $verify=0;
    $stmt=mysqli_prepare( $con,"SELECT count(id) FROM `$table_name` WHERE `$mobile`=? AND `$email`=? AND `$status_table`=? " );
    if( $stmt )
    {
        mysqli_stmt_bind_param ( $stmt,"iii",$verify,$verify,$status );
        mysqli_stmt_bind_result( $stmt,$count );
        if( mysqli_stmt_execute( $stmt ) && mysqli_stmt_fetch( $stmt ) )
        {
            return_data('success',$count);
        }
    }
    else
    {
        return_data('failed',"Something went wrong...");
    }
}

function count_all($table_name,$mobile,$email,$con)
{
    $verify=0;
    $stmt=mysqli_prepare( $con,"SELECT count(id) FROM `$table_name` WHERE `$mobile`=? AND `$email`=? " );
    if( $stmt )
    {
        mysqli_stmt_bind_param ( $stmt,"ii",$verify,$verify );
        mysqli_stmt_bind_result( $stmt,$count );
        if( mysqli_stmt_execute( $stmt ) && mysqli_stmt_fetch( $stmt ) )
        {
            return_data('success',$count);
        }
    }
    else
    {
        return_data('failed',"Something went wrong...");
    }
}

?>