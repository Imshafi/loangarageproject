<?php
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    if(isset($_SESSION['ADMIN_LOGIN_STATUS']) AND isset($_SESSION['ADMIN_ID'])        AND 
    !empty($_SESSION['ADMIN_LOGIN_STATUS'])   AND !empty($_SESSION['ADMIN_ID'])       AND
    is_bool($_SESSION['ADMIN_LOGIN_STATUS'])  AND is_numeric($_SESSION['ADMIN_ID'])   AND
    $_SESSION['ADMIN_LOGIN_STATUS']===true    AND $_SESSION['ADMIN_ID']==1){
        if( isset( $_POST['token'] )      && !empty( $_POST['token'] )      && $_POST['token']!==NULL      &&
            isset( $_POST['article_id'] ) && !empty( $_POST['article_id'] ) && $_POST['article_id']!==NULL && is_numeric( $_POST['article_id'] )
          )
          {
                if( isset( $_SESSION['EDIT_ARTICLE_TOKEN'] ) && !empty( $_SESSION['EDIT_ARTICLE_TOKEN'] ) )
                {
                    if( $_SESSION['EDIT_ARTICLE_TOKEN']==$_POST['token'] )
                    {
                        $id      = $_POST['article_id'];
                        require_once 'all.min.sub.php.dir/connection.all.min.php';
                        $stmt = mysqli_prepare( $con,"DELETE FROM `articles` WHERE `id`=?" );
                        if( $stmt )
                        {
                            mysqli_stmt_bind_param( $stmt,"i",$id );
                            if( mysqli_stmt_execute( $stmt ) )
                            {
                                return_data( "success","success" );
                            }
                            else
                            {
                                return_data( "failed","Something Went wrong" );
                            }
                            
                        }
                        else
                        {
                            return_data( "failed","Something Went wrong" );
                        }
                    }
                    else
                    {
                        return_data( "failed","Session Error Please Refresh the page" );
                    }
                }
                else
                {
                    return_data( "failed","Session Error Please Refresh the page" );
                }
          }
          else
          {
              return_data( "failed","Unable To Get Data Please Retry" );
          }
    }
    else
    {
        header("location:admin_home.php");
        die();
    }
    
    function return_data( $status,$data )
    {
        echo json_encode( ['status'=>$status,'data'=>$data] );
    }

?>