<?php
if(isset($_GET) && !empty($_GET) && isset($_GET['UID']) && is_numeric($_GET['UID']) && $_GET['UID']>0){
    define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.nav.php'; 
    require_once '../all.min.sub.php.dir/connection.all.min.php';
    $partner_id=xss_val($con,$_GET['UID']);
    $stmt_partner_data=mysqli_prepare($con,"SELECT pd.first_name,pd.last_name,pd.main_all_acc FROM partner_auth pa INNER JOIN form_information_submitted pd ON pd.id=pa.info WHERE pa.id=? AND pd.status=? AND pd.email_verify=? AND pd.mobile_verify=?");
    if($stmt_partner_data){
        $verify_status=0;
        mysqli_stmt_bind_param($stmt_partner_data,"iiii",$partner_id,$verify_status,$verify_status,$verify_status);
        mysqli_stmt_bind_result($stmt_partner_data,$fname,$lname,$iv);
        $exe=mysqli_stmt_execute($stmt_partner_data);
        $fetch=mysqli_stmt_fetch( $stmt_partner_data );
        mysqli_stmt_close( $stmt_partner_data );
        if( $exe>0 && $fetch>0 ){
            $partner_name=en_de_cry($con,$fname,$iv,"de")." ".en_de_cry($con,$lname,$iv,"de");
            echo "<script>var partner_id=$partner_id</script>";
        }else{
            header("location:admin_home.php?data=noDataFound");
            die();
        }
    }else{
        header("location:admin_home.php?data=oblectNotCreated");
        die();
    }
}else{
    header("location:admin_home.php");
    die();
} 
?>
        <link rel="stylesheet" href="../all.min.style_sheet.dir/partner_admin_chat.css">
        <div class="chat_whole_continer">
            <div class="heading_chat_admin name_con">
                <span class="heading_chat_lab name_lab"><?=$partner_name?></span>
            </div>
            <div class="msg_whole_continer" id="partner_admin_chat_con">
                
            </div>
            <div class="send_msg_con" id="send_msg_con_send">
                <textarea id="send_text" placeholder="Text Here..." class="send_msg_inp"></textarea>
                <button  class="send_text_btn"  id="send_text_btn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </body>
    <script src="admin.js.all.files/admin_partner_chat.js"></script>
</html>