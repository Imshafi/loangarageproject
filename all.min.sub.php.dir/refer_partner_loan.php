<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
    empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
    is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
    $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
        header("location:../partner_auth.php");
        die();
    }


    if(isset($_POST)){
        if($_POST['UID']==$_SESSION['PARTNER_ID']){
            include 'connection.all.min.php';
            $user_id=xss_val($con,$_SESSION['PARTNER_ID']);
            $refer_value=mt_rand(000000000000,999999999999);
            $refer_stmt=mysqli_prepare($con,"SELECT `id` FROM `refer_loan` WHERE `refer_value`=?");
            if($refer_stmt){
                while(check_value($refer_stmt,$refer_value,$con)){
                    $refer_value=mt_rand(000000000000,999999999999);
                }
                mysqli_stmt_close($refer_stmt);
                $time=date_format_cus();
                $stmt=mysqli_prepare($con,"INSERT INTO `refer_loan`(`partner_id`,`refer_value`,`time_refer`) VALUES(?,?,?)");
                if($stmt){
                    mysqli_stmt_bind_param($stmt,"iis",$user_id,$refer_value,$time);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_stmt_affected_rows($stmt)>0){
                        $get_stmt=mysqli_prepare($con,"SELECT `id` FROM `refer_loan` WHERE `partner_id`=? AND `refer_value`=? AND `time_refer`=?");
                        if($get_stmt){
                            mysqli_stmt_bind_param($get_stmt,"iis",$user_id,$refer_value,$time);
                            mysqli_stmt_bind_result($get_stmt,$refer_id);
                            $exe_stmt=mysqli_stmt_execute($get_stmt);
                            $fetch_stmt=mysqli_stmt_fetch($get_stmt);
                            mysqli_stmt_close($stmt);
                            if($exe_stmt>0 && $fetch_stmt>0 && !empty($refer_id)){
                                $_SESSION['time_refer']=$time;
                                mysqli_close( $con );
                                echo json_encode(['refer_id'=>$refer_id,'refer_value'=>$refer_value]);
                            }else{
                                return_values("failed","Please Try Again Not Getting Dataa");
                            }
                        }else{
                            return_values("failed","Please Try Again Not Getting Data");
                        }
                    }else{
                        return_values("failed","Please Try Again Not Inserted Data");
                    }
                }else{
                    return_values("failed","Object Not Create Please Try Later");
                }
            }else{
                return_values("failed","Object Not Create Please Try Later");
            }
        }else{
            return_values("failed","Mis Match UID");
        }
    }else{
        header("../index.php");
        die();
    }



    function check_value($refer_stmt,$value,$con){
        mysqli_stmt_bind_param($refer_stmt,"i",$value);
        mysqli_stmt_execute($refer_stmt);
        if(mysqli_stmt_fetch($refer_stmt)==1){
            return true;
        }else{
            return false;
        }
    }

    function return_values($status,$data){
        echo json_encode(['status'=>$status,'data'=>$data]);
    }

?>