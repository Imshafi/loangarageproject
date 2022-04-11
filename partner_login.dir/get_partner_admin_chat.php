<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
    empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
    is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
    $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
        header("location:../partner_auth.php");
        die();
    }
    if(isset($_POST['get']) AND $_POST['get']==="true" AND isset($_POST['type'])){
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
        if($_POST['type']==="once"){
            $chat_array=[];
            $get_chat=mysqli_query($con,"SELECT `id`,`time_com`,`admin_partner_com`,`mukhyam`,`sender_id` FROM `partner_admin` WHERE (`reciver_id`='$partner_id' AND `sender_id`='ADMIN_CHAT_PARTNER') || (`sender_id`='$partner_id' AND `reciver_id`='ADMIN_CHAT_PARTNER')");
        }else if($_POST['type']==="multiple"){
            $get_chat=mysqli_query($con,"SELECT `id`,`time_com`,`admin_partner_com`,`mukhyam` FROM `partner_admin` WHERE `reciver_id`='$partner_id' AND `sender_id`='ADMIN_CHAT_PARTNER' AND `status_com`=1");
        }
        if(mysqli_num_rows($get_chat)>0){
            $data=mysqli_fetch_all($get_chat,MYSQLI_ASSOC);
            for($i=0; $i<count($data); $i++){
                $data[$i]['admin_partner_com']=en_de_cry($con,$data[$i]['admin_partner_com'],$data[$i]['mukhyam'],"de");
                $data[$i]['time_com']=date_changer_custom($data[$i]['time_com']);
                if(isset($data[$i]['sender_id'])){
                    if($data[$i]['sender_id']==$partner_id){
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