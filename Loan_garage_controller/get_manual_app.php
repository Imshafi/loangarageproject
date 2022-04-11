<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
            header("location:../partner_auth.php");
            die();
    }
    if(isset($_POST['get']) && $_POST['get']==="true" && isset( $_POST['type_get'] ) && is_numeric( $_POST['type_get'] ) && !empty( $_POST['type_get'] ) ){
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $loan_applications=[];
        $email_confrim=0;
        $get_status=xss_val( $con,$_POST['type_get'] );
        if(isset($_POST['from']) && isset($_POST['to'])){
            $from=xss_val($con,$_POST['from']);
            $to=xss_val($con,$_POST['to']);
            $from=$from." 00:00:00";
            $to=$to." 23:59:59";
            $sql="SELECT `id`,`f_name`,`samaym_req`,`response`,`mukhyam` FROM `loan_apply_form` WHERE `mobile_confrim`=? AND `email_confrim`=? AND samaym_req >=? AND samaym_req <=? AND `status_loan`=?";
            $stmt_get_loans=mysqli_prepare($con,$sql);
            if($stmt_get_loans){
                mysqli_stmt_bind_param($stmt_get_loans,"iissi",$email_confrim,$email_confrim,$from,$to,$get_status);
                mysqli_stmt_execute($stmt_get_loans);
            }
        }else{
            $sql="SELECT `id`,`f_name`,`status_loan`,`samaym_req`,`response`,`mukhyam` FROM `loan_apply_form` WHERE  `mobile_confrim`=? AND `email_confrim`=? AND `status_loan`=?";
            $stmt_get_loans=mysqli_prepare($con,$sql);
            if($stmt_get_loans){
                mysqli_stmt_bind_param($stmt_get_loans,"iii",$email_confrim,$email_confrim,$get_status);
                mysqli_stmt_execute($stmt_get_loans);
            }
        }
        if($stmt_get_loans){
            mysqli_stmt_store_result($stmt_get_loans);
            if(mysqli_stmt_num_rows($stmt_get_loans)>0){
                mysqli_stmt_bind_result($stmt_get_loans,$id,$name,$status,$time,$response,$iv);
                while(mysqli_stmt_fetch($stmt_get_loans)){
                    $time=change_date($time);
                    $name=en_de_cry($con,$name,$iv,"de");
                    if( $status==0 )
                    {
                        $status="success";
                    }
                    elseif( $status==1 )
                    {
                        $status="progress";
                    }
                    else
                    {
                        $status="failed";
                    }
                    $array=[
                        'id'=>$id,
                        'name'=>$name,
                        'status'=>$status,
                        'time'=>$time,
                        'response'=>$response
                    ];
                    array_push($loan_applications,$array);
                    unset($array);
                }
                mysqli_stmt_close( $stmt_get_loans );
                echo json_encode($loan_applications);
            }else{
                ___return_data("no_data","No Data Found");
            }
        }else{
            ___return_data("failed","Oblect Not Created Please Retry..");
        }
    }else{
       header("location:../index.php");
    }
    function ___return_data($status,$data){
        echo json_encode(["status"=>$status,"data"=>$data]);
    }
?>
