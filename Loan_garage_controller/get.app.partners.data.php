<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}
if( isset( $_POST['token'] ) && !empty( $_POST['token'] ) && isset( $_POST['get'] ) &&  $_POST['get']=="true" )
{
    if( isset( $_SESSION['GET_PARTNER_DATA_FULL'] ) && !empty( $_SESSION['GET_PARTNER_DATA_FULL'] ) && $_POST['token']==$_SESSION['GET_PARTNER_DATA_FULL'] )
    {
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $query_partners=mysqli_query( $con,"SELECT pa.id,pd.first_name,pd.last_name,pd.main_all_acc FROM form_information_submitted pd INNER JOIN partner_auth pa ON pa.info=pd.id WHERE `status`=0 AND `email_verify`=0 AND `mobile_verify`=0 " );
        if( $query_partners )
        {
            if( mysqli_num_rows( $query_partners )>0 )
            {
                $retn_arry=[];
                $error=[];
                while( $partners=mysqli_fetch_assoc( $query_partners ) )
                {
                    $partner_id    = ( !empty( $partners['id']           ) )? xss_val( $con,$partners['id'] )                                            : err($error);
                    $partner_iv    = ( !empty( $partners['main_all_acc'] ) )? $partners['main_all_acc']                                                  : err($error);
                    $partner_fname = ( !empty( $partners['first_name']   ) )? xss_val( $con,en_de_cry( $con,$partners['first_name'],$partner_iv,"de" ) ) : err($error);
                    $partner_lname = ( !empty( $partners['last_name']    ) )? xss_val( $con,en_de_cry( $con,$partners['last_name'],$partner_iv,"de"  ) ) : err($error);
                    $partner_iv='';
                    if( empty($error) && !in_array( false,$error ) )
                    {
                        
                        array_push($retn_arry, [$partner_fname." ".$partner_lname,$partner_id] );
                    }
                    else
                    {
                        err($error);
                    }
                }
                if( empty( $error ) && !in_array( false,$error ) )
                {
                    return_data("success", json_encode( $retn_arry ));
                }
                else
                {
                    return_data("failed","Invalid Data");
                }
            }
            else
            {
                return_data("failed","Partners Not found");
            }
        }
        else
        {
            return_data("failed","Something went wrong");
        }
    }
    else
    {
        return_data("failed","Session Error Please reload page");
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
function err($err)
{
    array_push($err,false);
}
?>