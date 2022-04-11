<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['PARTNER_LOGIN_STATUS'])          OR !isset($_SESSION['PARTNER_ID'])            OR  
    empty($_SESSION['PARTNER_LOGIN_STATUS'])          OR  empty($_SESSION['PARTNER_ID'])            OR
    is_bool($_SESSION['PARTNER_LOGIN_STATUS'])==false OR is_numeric($_SESSION['PARTNER_ID'])==false OR
    $_SESSION['PARTNER_LOGIN_STATUS']==false     OR $_SESSION['PARTNER_ID']<1){
        header("location:../partner_auth.php");
        die();
    }
    if(isset($_POST['get']) AND $_POST['get']==="true"){
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
        if(isset($_POST['from']) && isset($_POST['to'])){
            $from=xss_val($con,$_POST['from']);
            $to=xss_val($con,$_POST['to']);
            $from=$from." 00:00:00";
            $to=$to." 23:59:59";
            $sql="SELECT re.user_id,ln.f_name,ln.email,ln.number,ln.status_loan,ln.samaym_req,ln.response,ln.mukhyam,ln.email_confrim,ln.mobile_confrim FROM refer_loan re INNER JOIN loan_apply_form ln ON ln.id=re.user_id AND ln.email_confrim=0 AND ln.mobile_confrim=0 WHERE `partner_id`='$partner_id' AND ln.samaym_req >='$from' AND ln.samaym_req <='$to'";
        }else{
            $sql="SELECT re.user_id,ln.f_name,ln.email,ln.number,ln.status_loan,ln.samaym_req,ln.response,ln.mukhyam FROM refer_loan re INNER JOIN loan_apply_form ln ON ln.id=re.user_id AND ln.email_confrim=0 AND ln.mobile_confrim=0 WHERE `partner_id`='$partner_id'";
        }
        $get_user_data=mysqli_query($con,$sql);
        if(mysqli_num_rows($get_user_data)>0){
            $user_data=mysqli_fetch_all($get_user_data,MYSQLI_ASSOC);
            $exist_email=[];
            $exist_number=[];
            $count=count($user_data);
            for($i=0; $i<$count; $i++)
            {
                $iv=$user_data[$i]['mukhyam'];
                if( $user_data[$i]['status_loan']==0 )
                {
                    $user_data[$i]['status_loan']="success";
                }
                elseif( $user_data[$i]['status_loan']==1 )
                {
                    $user_data[$i]['status_loan']="progress";
                }
                else
                {
                    $user_data[$i]['status_loan']="failed";
                }
                $de_name=en_de_cry($con,xss_val($con,$user_data[$i]['f_name']),$iv,"de");
                $date=explode(" ",$user_data[$i]['samaym_req']);
                $date=explode("-",$date[0]);
                $year=$date[0];
                $month=$date[1];
                $date=$date[2];
                $new_date=$date."-".$month."-".$year;
                unset($user_data[$i]['f_name']);
                unset($user_data[$i]['samaym_req']);
                $user_data[$i]['f_name']=$de_name;
                $user_data[$i]['samaym_req']=$new_date;
                array_push($exist_email,$user_data[$i]['email']);
                array_push($exist_number,$user_data[$i]['number']);
            }
            echo json_encode($user_data);
        }else{
            ___return_data("noData","No Data Found");
        }
    }else{
       header("location:../index.php");
    }
    function ___return_data($status,$data){
        echo json_encode(["status"=>$status,"data"=>$data]);
    }
?>
