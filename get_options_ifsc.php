<?php
require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';

if( isset( $_POST['name'] ) && isset( $_POST['state'] ) && isset( $_POST['dis'] )  && isset( $_POST['branch'] ) && isset( $_POST['token'] ) && count( $_POST )===5 )
{
    if( isset( $_SESSION['GET_IFSC_CODE'] ) &&  $_SESSION['GET_IFSC_CODE']==$_POST['token'] )
    {
        $error=[];
        $check=['name','state','dis','branch'];
        $a=0;
        for($i=0; $i<count( $check ); $i++)
        {
            if( $_POST[$check[$i]]=='' )
            {
                array_push($error,false);
            }
        }
        if( count( $error )==0 && !in_array( false,$error ) )
        {
            require_once 'all.min.sub.php.dir/connection.all.min.php';
            $name   = xss_val( $con,$_POST['name']   );
            $state  = xss_val( $con,$_POST['state']  );
            $dis    = xss_val( $con,$_POST['dis']    );
            $branch = xss_val( $con,$_POST['branch'] );
            $a=0;
            if( $name!=='def' &&  $state =='def' && $dis =='def' && $branch =='def' )
            {
                $query=mysqli_query( $con,"SELECT `adr4` FROM `data` WHERE `name` = '$name' GROUP BY adr4 ORDER BY adr4" );

            }elseif( $name!=='def' &&  $state !=='def' && $dis =='def' && $branch =='def' )
            {
                $query=mysqli_query( $con,"SELECT `adr3` FROM `data` WHERE `name` = '$name' AND `adr4`='$state' GROUP BY adr3 ORDER BY adr3" );

            }elseif( $name!=='def' &&  $state !=='def' && $dis !=='def' && $branch =='def' )
            {    $a=1;
                $query=mysqli_query( $con,"SELECT `adr1` FROM `data` WHERE `name` = '$name' AND `adr4`='$state' AND `adr3`='$dis' GROUP BY adr1 ORDER BY adr1" );
            }elseif( $name!=='def' &&  $state !=='def' && $dis !=='def' && $branch !=='def' )
            {
                $query=mysqli_query( $con,"SELECT `adr2`,`ifsc`,`adr5`,`contact`,`micr` FROM `data` WHERE `name` = '$name' AND `adr4`='$state' AND `adr3`='$dis' AND `adr1`='$branch'" );
            }
            if( mysqli_num_rows( $query )>0 )
            {
                return_data( "success",mysqli_fetch_all( $query ) );
            }
            else
            {
                return_data("failed","Data Not Found");
            }
        }
        else
        {
            return_data("failed","Invalid details");
        }
    }
    else
    {
        return_data("failed","Please refersh the page");
    }
}
else
{
   header("location:index.php");
}

function return_data($status,$data)
{
    echo json_encode( ['status'=>$status,'data'=>$data] );
}
?>