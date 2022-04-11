<?php
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
if( isset( $_POST['tkn'] ) && !empty( $_POST['tkn'] ) )
{
    if( isset( $_SESSION['GET_ALL_ARTICLES'] ) && !empty( $_SESSION['GET_ALL_ARTICLES'] ) && $_POST['tkn']==$_SESSION['GET_ALL_ARTICLES'] )
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        
        $query=mysqli_query( $con,"SELECT id,RPAD(heading,40),RPAD(content,70) FROM `articles`" );
        if( $query )
        {
            if( mysqli_num_rows( $query )>0 )
            {
                $error=[];
                $rtn_data=[];
                while($row=mysqli_fetch_row( $query ) )
                {
                    if( is_numeric( $row[0] ) && !empty( $row[1] ) && !empty( $row[2] ) )
                    {
                        array_push( $rtn_data,json_encode( ["id"=>xss_val($con,$row[0]),"heading"=>xss_date( edit_art( $row[1] ) ),"content"=>xss_date( edit_art( $row[2] ) ) ] ) );
                    }
                    else
                    {
                        array_push( $error,false );
                    }
                }
                if(empty( $error ) && !in_array( false,$error ) )
                {
                    rtn( "success",$rtn_data );
                }
                else
                {
                    rtn( "failed","Something went wrong please retry" );
                }
            }
            else
            {
                rtn("failed","Articles not found");
            }
        }
        else
        {
            rtn("failed","Please reload the page");
        }
    }
}
else
{
    header("location:index.php");
}

function rtn($status,$data)
{
    echo json_encode( ['status'=>$status,'data'=>$data] );
}