<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']<1){
            header("location:../partner_auth.php");
            die();
    }
    if(isset($_POST['get']) AND $_POST['get']==="true" AND isset($_POST['type']) AND isset($_POST['partner_id']) AND is_numeric($_POST['partner_id']) AND $_POST['partner_id']>0){
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $partner_id=xss_val($con,$_POST['partner_id']);
        $admin_id="ADMIN_CHAT_PARTNER";
        if($_POST['type']==="once"){
            $chat_array=[];
            $get_chat=mysqli_query($con,"SELECT `id`,`time_com`,`admin_partner_com`,`mukhyam`,`sender_id` FROM `partner_admin` WHERE (`reciver_id`='$partner_id' AND `sender_id`='$admin_id') || (`sender_id`='$partner_id' AND `reciver_id`='$admin_id')");
        }else if($_POST['type']==="multiple"){
            $get_chat=mysqli_query($con,"SELECT `id`,`time_com`,`admin_partner_com`,`mukhyam` FROM `partner_admin` WHERE `reciver_id`='$admin_id' AND `sender_id`='$partner_id' AND `status_com`=1");
        }
        if(mysqli_num_rows($get_chat)>0){
            $data=mysqli_fetch_all($get_chat,MYSQLI_ASSOC);
            for($i=0; $i<count($data); $i++){
                $data[$i]['admin_partner_com']=en_de_cry($con,$data[$i]['admin_partner_com'],$data[$i]['mukhyam'],"de");
                $data[$i]['time_com']=date_changer_custom($data[$i]['time_com']);
                if(isset($data[$i]['sender_id'])){
                    if($data[$i]['sender_id']==$admin_id){
                        $data[$i]['sender_id']="this";
                    }else{
                        $data[$i]['sender_id']="not_this";
                    }
                }else{
                    $data[$i]['sender_id']="not_this";
                }
                unset($data[$i]['mukhyam']);
            }
            echo json_encode($data);
        }else{
            echo json_encode(['status'=>"failed","data"=>"No Msg Yet.."]);
        }
    }else{
        header("location:../partner_auth.php");
        die();
    }

?>