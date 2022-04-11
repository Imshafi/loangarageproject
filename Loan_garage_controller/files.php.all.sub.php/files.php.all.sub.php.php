<?php
    if(isset($_POST) AND !empty($_POST) AND count($_POST)==3){
        include '../../all.inc.fle.php.dir/al-fun-form-functions.php';
        include '../../all.min.sub.php.dir/connection.all.min.php';
        if(isset($_SESSION['ADMIN_LOGIN_TOKEN']) AND !empty($_SESSION['ADMIN_LOGIN_TOKEN'])){
            if(isset($_POST['csrf_token']) AND !empty($_POST['csrf_token'])){
                if($_SESSION['ADMIN_LOGIN_TOKEN']==$_POST['csrf_token']){
                    $user_name=xss_val($con,$_POST['user_name']);
                    $password=xss_val($con,$_POST['user_password']);
                    $user_id=1;
                    $stmt=mysqli_prepare($con,"SELECT `user_password`,`user_name` FROM `admin_auth` WHERE `id`=?");
                    if($stmt){
                        mysqli_stmt_bind_param($stmt,"i",$user_id);
                        mysqli_stmt_bind_result($stmt,$base_pass,$base_user_name);
                        $exe=mysqli_stmt_execute($stmt);
                        $fetch=mysqli_stmt_fetch( $stmt );
                        mysqli_stmt_close( $stmt );
                        if( $exe>0 && $fetch>0 ){
                            // $password=password_hash($password,PASSWORD_DEFAULT); hashing password
                            if(password_verify($user_name,$base_user_name)==1){
                                if(password_verify($password,$base_pass)==1){
                                    $_SESSION['ADMIN_LOGIN_STATUS']=true;
                                    $_SESSION['ADMIN_ID']=$user_id;
                                    unset( $_SESSION['ADMIN_LOGIN_TOKEN'] );
                                    mysqli_close( $con );
                                    echo return_data("success","login");
                                }else{
                                    echo return_data("failed","Enter Valid Details...");
                                }
                            }else{
                                echo return_data("failed","Enter Valid Details...");
                            }
                        }else{
                            echo return_data("failed","Enter Valid User Name..");
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
    }else{
        header("location:../../index.php");
    }
    function return_data($status,$data){
        return json_encode(["status"=>$status,"data"=>$data]);
    }
?>