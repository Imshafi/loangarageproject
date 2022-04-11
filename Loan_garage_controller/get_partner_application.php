<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
            header("location:../partner_auth.php");
            die();
    }
    if(isset($_POST['get']) AND $_POST['get']==="true"){
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $loan_applications=[];
        $email_confrim=0;
        $mobile_confrim=0;
        $status_acc=1;
        $run=0;
        $sql="SELECT `id`,`first_name`,`reg_time`,`main_all_acc` FROM `form_information_submitted` WHERE `mobile_verify`=? AND `email_verify`=? AND `status`=? ORDER BY `id` DESC";
        $stmt_get_loans=mysqli_prepare($con,$sql);
        if($stmt_get_loans){
            mysqli_stmt_bind_param($stmt_get_loans,"iii",$email_confrim,$mobile_confrim,$status_acc);
            mysqli_stmt_execute($stmt_get_loans);
            mysqli_stmt_store_result($stmt_get_loans);
            if(mysqli_stmt_num_rows($stmt_get_loans)>0){
                mysqli_stmt_bind_result($stmt_get_loans,$id,$name,$time,$iv);
                while(mysqli_stmt_fetch($stmt_get_loans)){
                    $name=en_de_cry($con,$name,$iv,"de");
                    $time=change_date($time);
                    $array=[
                        'id'=>$id,
                        'name'=>$name,
                        'time'=>$time
                    ];
                    array_push($loan_applications,$array);
                    unset($array);
                }
                echo json_encode($loan_applications);
            }else{
                ___return_data("no_data","No Data Found");
            }
            mysqli_stmt_close( $stmt_get_loans );
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
