<?php 
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    if( !isset( $_SESSION['CONFRIM_PARTNER_MAIL'] ) || empty( $_SESSION['CONFRIM_PARTNER_MAIL'] ) || !isset( $_SESSION['CONFRIM_PARTNER_UID'] ) || empty( $_SESSION['CONFRIM_PARTNER_UID'] ) || !is_numeric($_SESSION['CONFRIM_PARTNER_UID']) )
    {
        header("location:index.php");
    }
    if( valid_email( $_SESSION['CONFRIM_PARTNER_MAIL'] ) )
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        $user_mail=xss_val($con,$_SESSION['CONFRIM_PARTNER_MAIL']);
        $user_uid=xss_val($con,$_SESSION['CONFRIM_PARTNER_UID']);
        $stmt_check=mysqli_prepare($con,"SELECT fd.id FROM form_information_submitted fd INNER JOIN partner_auth pa ON pa.info=fd.id WHERE fd.id=? AND fd.email =? AND fd.mobile_verify=? AND fd.email_verify=? AND fd.status=? ORDER BY fd.id DESC");
        if( $stmt_check )
        {
            $status=0;
            $sta=1;
            mysqli_stmt_bind_param( $stmt_check,"isiii",$user_uid,$user_mail,$status,$status,$sta );
            mysqli_stmt_bind_result( $stmt_check,$id );
            mysqli_stmt_execute( $stmt_check );
            mysqli_stmt_store_result($stmt_check );
            if( mysqli_stmt_num_rows( $stmt_check )==0 )
            {
                noerr();
            }
            else
            {
                header("location:index.php");
            }
            mysqli_stmt_close( $stmt_check );
        }
        else
        {
            header("location:index.php");
        }
    }
    else
    {
        header("location:index.php");
    }
    function noerr()
    {
        require_once 'all.inc.fle.php.dir/inc.fle.php';
?>
<link rel="stylesheet" href="all.min.style_sheet.dir/register.css">
<title>
    Partner Registration
</title>
<script src="all.js.min.dir/validation_login.js"></script>
</head>
<body>
    <div class="loader_con">
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
    </script>
    <div class="wholeContiner">
        <div class="subContiner">
            <div class="header_con">
                <h2 class="heading">
                    Partner Registration
                </h2>
            </div>
            <form method="post" id="register_form">
                <table>
                    <tr>
                        <td>
                            <label for="user_name_inp" class="lab">User Name</label>
                        </td>
                        <td>
                            <input type="text" class="inp" name="user_name" required id="user_name_inp">
                        </td>
                    </tr>
                    <tr id="error_user_name" class="nodis error_msg_pir">
                        <td colspan=2>
                            6 To 10 Characters must contain A to Z , a to z and numbers
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="user_password_one_inp" class="lab">User Password</label>
                        </td>
                        <td>
                            <input type="password" class="inp" name="user_password" required id="user_password_one_inp">
                        </td>
                    </tr>
                    <tr id="error_user_password" class="nodis error_msg_pir">
                        <td colspan=2>
                            8 To 12 Characters must contain A to Z , a to z , numbers and special characters
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="user_password_one_inp" class="lab">Confrim User Password</label>
                        </td>
                        <td>
                            <input type="password" class="inp" name="confrim_password" required id="user_password_two_inp">
                        </td>
                    </tr>
                    <tr class="nodis" id="error_con">
                        <td colspan=2>
                            <span class="error" id="error_msg">Error Occured</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2 class="btn_con">
                            <input type="submit" class="inp_sub" required id="register">
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="csrf_register" value="<?=token("REGISTER_PARTNER")?>">
            </form>
        </div>
    </div>
</body>
<script>
    var error_con=document.getElementById("error_con");
    var error_msg=document.getElementById("error_msg");
    var error_user_name=document.getElementById("error_user_name");
    var error_user_password=document.getElementById("error_user_password");
    jQuery('#register_form').on('submit',function(e){
        e.preventDefault();
        form_data=new FormData(this);
        if( validate_user_name( form_data.get( "user_name" ) ) )
        {
            error_user_name.classList.add("nodis");
            error( "noer","User Name" );
            if( validate_password( form_data.get( "user_password" ) ) )
            {
                error_user_password.classList.add("nodis");
                error( "noer","User Password" );
                if( validate_user_name( form_data.get( "user_password" ) )===validate_user_name( form_data.get( "confrim_password" ) ) )
                {
                    set_auth_partner();
                }
                else
                {
                    error( "er","Mismatch Confrim Password" );
                }
            }
            else
            {
                error_user_password.classList.remove("nodis");
                error( "er","Invalid User Password" );
            }
        }
        else
        {
            error_user_name.classList.remove("nodis");
            error( "er","Invalid User Name" );
        }
    })

    function error(type,data)
    {
        if( type=="er" )
        {
            error_con.classList.remove("nodis");
            error_msg.innerText=data;
        }
        else
        {
            error_con.classList.add("nodis");
            error_msg.innerText="Nothing";
        }
    }

    function set_auth_partner()
    {
        document.getElementById("register").value="Please Wait ...";
        $.ajax({
        url:"set_auth_partner.php",
        type:"POST",
        data:form_data,
        contentType:false,
        processData:false,
        success:function(data){
            if( Object.entries(data).length>0 ){
                data=$.parseJSON(data);
                if(data.constructor==Object){
                    if(data.status=="success"){
                        window.location.href="success.php";
                    }else{
                        error("er",data.data);
                    }
                }else{
                    error("er","Data Not Found Please Retry")
                }
            }else{
                error("er","Data Not Found Please Retry");
            }
            document.getElementById("register").value="Submit"
        }
    })
    }
</script>
<?php
    }
?>