<?php

require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
if(!isset($_SESSION['ADMIN_LOGIN_STATUS'])          OR !isset($_SESSION['ADMIN_ID'])            OR  
    empty($_SESSION['ADMIN_LOGIN_STATUS'])          OR  empty($_SESSION['ADMIN_ID'])            OR
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])==false OR is_numeric($_SESSION['ADMIN_ID'])==false OR
    $_SESSION['ADMIN_LOGIN_STATUS']==false     OR $_SESSION['ADMIN_ID']!==1){
        header("location:../partner_auth.php");
        die();
}

if( check('token') && check('heading') && check('content') )
{
    if( isset( $_SESSION['ARTICLE_INSERT'] ) && $_SESSION['ARTICLE_INSERT']==$_POST['token'] )
    {
        if( isset( $_FILES['image'] ) && is_array( $_FILES['image'] ) )
        {
            $error=[];
            $allow_img=['JPG','JPEG','PNG'];
            $file=$_FILES['image'];
            if( $file['name']!=='' && $file['type']!=='' && $file['tmp_name']!=='' && $file['error']==0 && $file['size']>0 )
            {
                $file_name=explode('.',$_FILES['image']['name']);
                $file_ext=strtoupper(end($file_name));

                if( in_array($file_ext,$allow_img) )
                {
                    require_once '../all.min.sub.php.dir/connection.all.min.php';
                    $image_name=uniqid('',true).".".$file_ext;
                    $heading=xss_val( $con,$_POST['heading'] );
                    $content=xss_val( $con,$_POST['content'] );
                    $stmt=mysqli_prepare( $con,"INSERT INTO `articles`(`heading`,`img`,`content`) VALUES(?,?,?)" );
                    if( $stmt )
                    {
                        mysqli_stmt_bind_param( $stmt,"sss",$heading,$image_name,$content );
                        $exe=mysqli_stmt_execute( $stmt );
                        $aff=mysqli_stmt_affected_rows( $stmt );
                        if( $exe && $aff )
                        {
                            if( move_uploaded_file($file['tmp_name'],"../web.picture.dir/articles.images/".$image_name ) )
                            {
                                rtn("success","success");
                            }
                            else {
                                rtn("failed","Post Uploded but unable to upload image");
                            }
                        }
                        else
                        {
                            rtn("failed","Unable to upload post");
                        }
                    }
                    else
                    {
                        rtn("failed","Something went wrong");
                    }
                }
                else 
                {
                    rtn("failed","Invalid Imgae");
                }
            }
            else
            {
                rtn("failed","Image Error Please retry");
            }
        }
        else
        {
            rtn("failed","Image Error Please retry1");
        }
    }
    else
    {
        rtn("failed","Session Error Please reload page");
    }
}
else
{
    header( "location:index.php" );
}
// ARTICLE_INSERT
// [token] => 8366515d590f16873f430f16b16cdc56f3628a6a4b7ecebfeb16ee42cf5f98bc
// [heading] => dsfsdfsf
// [content] => dfdsfsdfs
// [image] => Array
// (
//     [name] => Screenshot (2).png
//     [type] => image/png
//     [tmp_name] => C:\xampp\tmp\phpC539.tmp
//     [error] => 0
//     [size] => 164564
// )

function check($inp)
{
    return ($_POST[$inp] ) && !empty( $_POST[$inp] );
}

function rtn($status,$data)
{
    echo json_encode( ['status'=>$status, 'data'=>$data ] );
}
