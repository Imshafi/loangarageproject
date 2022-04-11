<?php

require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:admin_home.php");
        die();
}
if( check("token") && check("from") && check("to") && check( "partner_id" ) && is_numeric( $_POST['partner_id'] ) )
{
    if( isset( $_SESSION['GET_PARTNER_WORKING'] ) && $_SESSION['GET_PARTNER_WORKING']===$_POST['token'] )
    {
        require_once '../all.min.sub.php.dir/connection.all.min.php';

        $from=xss_date( $_POST['from'] );
        $to=xss_date( $_POST['to'] );
        $partner_id=xss_val( $con,$_POST['partner_id'] );
        $error=[];
        $status=0;
        if( $from=="nothing" && $to=="nothing" )
        {
            $stmt=mysqli_prepare( $con,"SELECT lf.id,lf.f_name,lf.l_name,lf.status_loan,lf.mukhyam,lf.samaym_req,rl.dabbu,rl.id FROM refer_loan rl INNER JOIN loan_apply_form lf ON lf.id=rl.user_id WHERE lf.check_sent=? AND lf.check_sent_two=? AND rl.refer_status=? AND rl.partner_id=?" );
            if( $stmt )
            {
                mysqli_stmt_bind_param( $stmt,"iiii",$status,$status,$status,$partner_id );
                mysqli_stmt_bind_result( $stmt,$loan_id,$fname,$lname,$status,$iv,$time,$amt,$refer_id );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_store_result( $stmt );
                $row=mysqli_stmt_num_rows( $stmt );
            }
            else
            {
                array_push($error,false);
            }
        }
        else
        {
            $stmt=mysqli_prepare( $con,"SELECT lf.id,lf.f_name,lf.l_name,lf.status_loan,lf.mukhyam,lf.samaym_req,rl.dabbu,rl.id FROM refer_loan rl INNER JOIN loan_apply_form lf ON lf.id=rl.user_id WHERE lf.check_sent=? AND lf.check_sent_two=? AND rl.refer_status=? AND rl.partner_id=? AND samaym_req >=? AND samaym_req <=? " );
            if( $stmt )
            {
                $from=$from." 00:00:00";
                $to=$to." 23:59:59";
                mysqli_stmt_bind_param( $stmt,"iiiiss",$status,$status,$status,$partner_id,$from,$to );
                mysqli_stmt_bind_result( $stmt,$loan_id,$fname,$lname,$status,$iv,$time,$amt,$refer_id );
                mysqli_stmt_execute( $stmt );
                mysqli_stmt_store_result( $stmt );
                $row=mysqli_stmt_num_rows( $stmt );
            }
            else
            {
                array_push($error,false);
            }
        }
        if( !in_array( false,$error ) && count( $error )==0 )
        {
            if( $row>0 )
            {
                $all=[];

                while ( mysqli_stmt_fetch( $stmt ) )
                {
                    if( num($loan_id) && num($status) && num($amt) && !empty( $fname ) && !empty( $lname )&& !empty( $iv ) )
                    {
                        $arr=['id'=>xss_val( $con,$loan_id ),'name'=>en_de_cry($con,$fname,$iv,"de")." ".en_de_cry($con,$lname,$iv,"de"),'status'=>xss_val( $con,$status ),'time'=>change_date( $time ),'amt'=>xss_val( $con,$amt ),'refer_id'=>xss_val( $con,$refer_id ) ];
                        array_push( $all,json_encode( $arr ) );
                    }
                    else
                    {
                        array_push($error,false);
                    }
                }
                if( !in_array( false,$error ) && count( $error )==0 )
                {
                    rtn_data( "success",$all );
                }
                else
                {
                    rtn_data("failed","Something went wrong");
                }
            }
            else
            {
                rtn_data("failed","Data Not Found");
            }
        }
        else
        {
            rtn_data("failed","Something went wrong");
        }
    }
    else
    {
        rtn_data("failed","Plese refersh page");
    }
}
else
{
    header("location:admin_home.php");
}

function rtn_data($status,$data)
{
    echo json_encode( ['status'=>$status,'data'=>$data] );
}
function num($val)
{
    return ( $val!=='' && is_numeric( $val ) );
}
function check($val)
{
    return  isset( $_POST[$val] ) && !empty( $_POST[$val] );
}