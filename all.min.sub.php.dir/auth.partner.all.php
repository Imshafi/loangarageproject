<?php
    if(isset($_POST) AND !empty($_POST) AND count($_POST)==3){
        include '../all.inc.fle.php.dir/al-fun-form-functions.php';
        include 'connection.all.min.php';
        if(isset($_SESSION['PARTNER_LOGIN_TOKEN']) AND !empty($_SESSION['PARTNER_LOGIN_TOKEN'])){
            if(isset($_POST['csrf_token']) AND !empty($_POST['csrf_token'])){
                if($_SESSION['PARTNER_LOGIN_TOKEN']==$_POST['csrf_token']){
                    $user_name=xss_val($con,$_POST['user_name']);
                    $password=xss_val($con,$_POST['user_password']);
                    $stmt=mysqli_prepare($con,"SELECT pa.user_password,pa.id,pd.status,pd.email_verify,pd.mobile_verify FROM partner_auth pa INNER JOIN form_information_submitted pd ON pd.id = pa.info  WHERE `user_name`=? ORDER BY id DESC");
                    if($stmt){
                        mysqli_stmt_bind_param($stmt,"s",$user_name);
                        mysqli_stmt_bind_result($stmt,$base_pass,$base_id,$user_status,$user_email_status,$user_mobile_status);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        if( mysqli_stmt_num_rows( $stmt )>0 )
                        {
                            if(mysqli_stmt_fetch($stmt)){
                                if($user_status==0){
                                    if($user_email_status==0){
                                        if($user_mobile_status==0){
                                            if($base_id>0){
                                                if(password_verify($password,$base_pass)==1){
                                                    mysqli_stmt_close( $stmt );
                                                    $_SESSION['PARTNER_LOGIN_STATUS']=true;
                                                    $_SESSION['PARTNER_ID']=$base_id;
                                                    unset($_SESSION['PARTNER_LOGIN_TOKEN']);
                                                    mysqli_close( $con );
                                                    echo return_data("success","login");
                                                }else{
                                                    echo return_data("failed","Invalid Details");
                                                }
                                            }else{
                                                echo return_data("failed","UID Problem Please Contact With Admin");
                                            }
                                        }else{
                                            echo return_data("failed","Please Verify Your Mobile Number..");
                                        }
                                    }else{
                                        echo return_data("failed","Please Verify Your Email..");
                                    }
                                }else{
                                    echo return_data("failed","Admin Not Verify Your Account . Please Try Later..");
                                }
                            }else{
                                echo return_data("failed","Invalid Details");
                            }
                        }
                        else
                        {
                            echo return_data("failed","Invalid Details");
                        }
                    }else{
                        echo return_data("failed","Query Problem Please Retry...");
                    }
                }else{
                    echo return_data("failed","Token Problem Not Match Please REfersh Page.");
                }
            }else{
                echo return_data("failed","Token Problem Please REfersh Page.");
            }
        }else{
            echo return_data("failed","Session Problem Please REfersh Page.");
        }
    }else{?>
        <script>
            window.location.href="../partner_auth.php";
        </script>
    <?php
    }

    function return_data($status,$data){
        return json_encode(["status"=>$status,"data"=>$data]);
    }
?>