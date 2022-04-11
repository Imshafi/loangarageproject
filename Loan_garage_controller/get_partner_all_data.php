
<?php
    require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
    if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
        empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
        is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
        $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
            header("location:../partner_auth.php");
            die();
    }
    if( isset($_GET['uid'] ) && !empty( $_GET['uid'] ) && is_numeric( $_GET['uid'] ))
    {
        require_once '../all.min.sub.php.dir/connection.all.min.php';
        $partner_id=xss_val($con, $_GET['uid'] );
        $sta=0;
        $ch=mysqli_prepare( $con,"SELECT fd.first_name,fd.main_all_acc FROM partner_auth rd INNER JOIN form_information_submitted fd ON fd.id=rd.info WHERE fd.status=? AND fd.email_verify=? AND fd.mobile_verify=? AND rd.id=? " );
        if( $ch )
        {
            mysqli_stmt_bind_param( $ch,"iiii",$sta,$sta,$sta,$partner_id );
            mysqli_stmt_bind_result( $ch,$name,$iv);
            $exe=mysqli_stmt_execute( $ch );
            $fet=mysqli_stmt_fetch( $ch );
            mysqli_stmt_close( $ch );
            if( $exe && $fet && !empty( $name ) && !empty( $iv ) )
            {
                al_ok($partner_id,en_de_cry($con,$name,$iv,"de"));
            }
            else
            {
                echo "Unable to fetch data";
                die();
            }
        }
        else
        {
            echo "Unable to fetch data";
            die();
        }
    }
    else
    {
        header("location:index.php");
        die();
    }
function al_ok($id,$name)
{
    define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
    require_once 'all.inc.nav.php';  
    $admin_id=$_SESSION['ADMIN_ID'];
?>
    <div class="loader_con" id="loading_cir">
        <div class="loading">
        </div>
    </div>
    <style>
        .loader_con
        {
            background-color:rgb(218 218 218 / 0.7);
            height:100vh;
            width:100%;
            position:absolute;
            display:flex;
            justify-content:center;
            align-items:center;
            z-index:1;
        }
        .loading
        {
            height:50px;
            width:50px;
            border-top:5px solid #11e311;
            border-radius:50%;
            animation:rotate 1s infinite;
            margin:80px auto;
        }
        @keyframes rotate
        {
            from
            {
                transform:rotate(0deg);
            }
            to
            {
                transform:rotate(360deg);
            }
        }
    </style>
    <script>
        window.addEventListener("load",()=>{
            document.querySelector(".loader_con").style.display="none";
        })
        var user="<?=$id?>";
    </script>
    <link rel="stylesheet" href="admin.style.all.files/get_all_partner.css">
        <div class="continer">
            <div class="error_con" id="shw_msg">
                Error
            </div>
            <div class="name_con">
                <div class="user_data">
                    <a id="chat_partner" class="anc cht">Chat</a>
                    <script>document.getElementById("chat_partner").href="admin_partner_chat.php?UID="+user</script>
                    <h3 id="loading" style="display:inline"><?=$name?></h3>
                </div>
                <div class="form_con">
                    <form id="get_data">
                        <input type="hidden" name="token"  value="<?=token("GET_PARTNER_WORKING")?>" id="token_val">
                        <input type="date"   name="from"   class="inp" required>
                        <input type="date"   name="to"     class="inp" required>
                        <input type="submit" name="submit" class="inp anc sub" value="Get">
                    </form>
                </div>
            </div>
            <div class="holder">
                <div id="all_con">
                </div>
            </div>
        </div>
    </body>
</html>
<script src="admin.js.all.files/get_partner_all_data.js"></script>
<?php
}
?>