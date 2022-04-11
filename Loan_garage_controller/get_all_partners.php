<?php
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}
if(isset($_POST) && !empty($_POST) && isset($_POST['get'])&& $_POST['get']=="true" && isset($_POST['admin_id']) && is_numeric($_POST['admin_id']) && $_POST['admin_id']>0){
    require_once '../all.min.sub.php.dir/connection.all.min.php';
    $admin_id="ADMIN_CHAT_PARTNER";
    $stmt_partners=mysqli_query($con,"SELECT `sender_id`,`reciver_id`,`status_com` FROM `partner_admin` WHERE (sender_id='$admin_id' || reciver_id='$admin_id') ORDER BY id DESC");
    if($stmt_partners){
        if(mysqli_num_rows($stmt_partners)>0){
            $exist=[];
            $rtn_data=[];
            $error_array=[];
            while ($row=mysqli_fetch_assoc($stmt_partners)) {
                if($row['sender_id']==="ADMIN_CHAT_PARTNER"){
                    $partner_id=$row['reciver_id'];
                }else{
                    $partner_id=$row['sender_id'];
                }
                $partner_id=xss_val($con,$partner_id);
                if(is_numeric($partner_id) && $partner_id!==0){
                    if(!in_array($partner_id,$exist)){
                        $partner_query=mysqli_query($con,"SELECT pd.first_name,pd.last_name,pd.main_all_acc FROM partner_auth pa INNER JOIN form_information_submitted pd ON pd.id=pa.info WHERE pa.id=$partner_id AND pd.status=0 AND pd.mobile_verify=0 AND pd.email_verify=0");
                        if($partner_query){
                            if(mysqli_num_rows($partner_query)>0){
                                $partner_data=mysqli_fetch_assoc($partner_query);
                                $partner_name=en_de_cry($con,$partner_data['first_name'],$partner_data['main_all_acc'],"de")." ".en_de_cry($con,$partner_data['last_name'],$partner_data['main_all_acc'],"de");
                                $data_array=["name"=>$partner_name,"id"=>$partner_id,"msg_status"=>$row['status_com']];
                                array_push($rtn_data,$data_array);
                            }else{
                                array_push($error_array,false);
                            }
                        }else{
                            array_push($error_array,false);
                        }
                        array_push($exist,$partner_id);
                    }
                }else{
                    array_push($error_array,false);
                }
                
            }
            if(empty($error_array) && !in_array(false,$error_array)){
                $rtn_full=["status"=>"success","data"=>$rtn_data];
                echo json_encode($rtn_full);
            }else{
                return_data("failed","Invalid Data");
            }
        }else{
            return_data("no_data","No Data Found");
        }
    }else{
        return_data("failed","Failed To Create Object");
    }
}else{
    header("location:index.php");
    die();
}
function return_data($status,$data){
    echo json_encode(["status"=>$status,"data"=>$data]);
}
?>