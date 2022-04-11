<?php
session_start();
// session_regenerate_id( true );
$a=0;

function a($ar){
    echo"<pre>";
    print_r($ar);
}
function e($s){
    echo $s;
}
function en_de_cry($con,$val,$iv,$type){
    $keys=["AES-128-CTR","%1^904)(*>>:)HelloWorld:)<<&342()*((^^%32$%^$(HF:aef",0,1234567890123456];
    if($type=="en"){
        $val=strip_tags($val);
        $val=htmlspecialchars($val);
        $val=mysqli_real_escape_string($con,$val);
        return openssl_encrypt($val,$keys[0],$keys[1],$keys[2],$iv);
    }else{
        $iv=hex2bin($iv);
        $val=openssl_decrypt($val,$keys[0],$keys[1],$keys[2],$iv);
        $val=strip_tags($val);
        $val=htmlspecialchars($val);
        $val=mysqli_real_escape_string($con,$val);
        return $val;
    }
}
function token($token_name){
    $token=bin2hex( random_bytes(32) );
    $_SESSION[$token_name]=$token;
    return $token;
}
function xss_date($val){
    $val=strip_tags($val);
    $val=htmlspecialchars($val);
    return $val;
}
function xss_val($con,$val){
    $val=strip_tags($val);
    $val=htmlspecialchars($val);
    $val=mysqli_real_escape_string($con,$val);
    return $val;
}
function valid_email($val){
    $val = filter_var($val, FILTER_SANITIZE_EMAIL);
    if (!filter_var($val, FILTER_VALIDATE_EMAIL) === false) {
        return $val;
    } else {
        return "failed";
    }
}
function date_format_cus(){
    date_default_timezone_set('Asia/Kolkata');
    return Date('h/i/s/a/d/D/M/y');
}
function date_changer_custom($old){
    $old=explode("/",$old);
    $new=date_format_cus();
    $new=explode("/",$new);
    if($old[7]==$new[7]){
        if($old[6]==$new[6]){
            if($old[4]==$new[4]){
                if($old[0]==$new[0] && $old[3]==$new[3]){
                    if($old[1]==$new[1]){
                        return "Just Now";
                    }else{
                        return $new[1]-$old[1]." min ago";
                    }
                }else{
                    return $old[0].":".$old[1]." ".$old[3];
                }
            }else{
                return $old[4]." ".$old[6];
            }
        }else{
            return $old[4]." ".$old[6];
        }
    }else{
        return $old[4]." ".$old[6]." ".$old[7];
    }
}
function dOB($date){
    if(strpos($date,"-") !==false){
        $date=explode("-",$date);
        if(is_array($date)){
            return $date[2]."/".$date[1]."/".$date[0];
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function change_date($date){
    $date=xss_date($date);
    $date=explode(" ",$date);
    $date=explode("-",$date[0]);
    $year=$date[0];
    $month=$date[1];
    $date=$date[2];
    return $date."-".$month."-".$year;
}

function edit_art( $val )
{
    $val = preg_replace('#(\\\r|\\\r\\\n|\\\n)#', '<br>', $val);
    $val = preg_replace('#(\\r|\\r\\n|\\n)#', '<br>', $val);
    $val = preg_replace('#(\r|\r\n|\n)#', '<br>', $val);
    $val = str_replace('\\',' ',$val);
    return $val;
}
?>