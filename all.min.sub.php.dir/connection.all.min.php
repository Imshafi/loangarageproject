<?php
$con=mysqli_connect("localhost","root","","Loan");
try{
    if($con){
        
    }else{
        throw new Exception("Failed To Connect...");
    }
}catch(Exception $e){
    echo $e->getMessage();

}
?>
