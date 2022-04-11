<?php
if( isset($_POST['tkn'] ) && isset( $_POST['ifsc'] ) && !empty( $_POST['tkn'] ) && !empty( $_POST['ifsc'] ) )
{
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    $rgx="/^[A-Z]{1}[A-Z0-9]{10}$/";
    if(preg_match($rgx,$_POST['ifsc']))
    {
        require_once 'all.min.sub.php.dir/connection.all.min.php';
        $ifsc=xss_val( $con,$_POST['ifsc'] );
        $stmt=mysqli_prepare( $con,"SELECT `name`,`adr1`,`adr2`,`adr3`,`adr4`,`adr5`,`contact`,`micr` FROM `data` WHERE `ifsc`=?" );
        if( $stmt )
        {
            mysqli_stmt_bind_param( $stmt,"s",$ifsc );
            mysqli_stmt_bind_result( $stmt,$name,$adr1,$adr2,$adr3,$adr4,$adr5,$contact,$micr );
            $exe=mysqli_stmt_execute( $stmt );
            mysqli_stmt_store_result( $stmt );
            $row=mysqli_stmt_num_rows( $stmt );
            $fetch=mysqli_stmt_fetch( $stmt );
            if( $row )
            {
                if($exe && $fetch )
                {
                    return_data( "success",json_encode( ['name'=>$name,'adr1'=>$adr1,'adr2'=>$adr2,'adr3'=>$adr3,'adr4'=>$adr4,'adr5'=>$adr5,'contact'=>$contact,'micr'=>$micr] ) );
                }
                else
                {
                    return_data("failed","Something went wrong please retry");
                }
            }
            else
            {
                return_data("failed","Data not found");
            }
        }
        else
        {
            return_data("failed","Something went wrong please retry");
        }
    }
    else
    {
        return_data("failed","Invalid IFSC CODE");
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