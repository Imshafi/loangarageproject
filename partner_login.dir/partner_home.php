<?php
define("A0(57%?<Fr@4**&__Partner___K#2*&(J^8392$()8347&^",true);
require_once 'partner_inc.php';
require_once '../all.inc.fle.php.dir/al-fun-form-functions.php';
require_once '../all.min.sub.php.dir/connection.all.min.php';
$partner_id=xss_val($con,$_SESSION['PARTNER_ID']);
?>
        <link rel="stylesheet" href="../all.min.style_sheet.dir/partner_home.css">
        <div class="allContner">
            <div class="error_continer" id="error_continer">
                <span class="error_msg" id="error_msg">Error Occured</span>
            </div>
            <div class="main_head_con">
                <div class="myactv">My Activity</div>
                <div class="name_refer">
                    <span class="partner_name">Anas</span>
                    <span class="add_refer" id="refer_btn_id">+</span>
                </div>
            </div>
            <div class="main_head_con main_filter_approval">
                <div class="myactv myper">My Approval Rate: <span class="performace_span"><span id="res">0</span>%</span></div>
                <div class="name_refer filter_con">
                    <input type="date" name="date_one" id="date_one">
                    <span class="to">to</span>
                    <input type="date" name="date_two" id="date_two">
                    <button calss="filter_btn" id="filter_get_data">Filter</button>
                    <div class="date_error" id="date_error">Select Date</div>
                </div>
            </div>
            <div class="table_con">
                <table class="reffer_table" border="1">
                    <thead  cell-padding="10">
                        <tr class="tr_head">
                            <th>S.No</th>
                            <th>Client Name</th>
                            <th class="res_val">Admin Response</th>
                            <th>Loan Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody  id="table_activity_partner">
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<script>
    var user_id="<?=$_SESSION['PARTNER_ID']?>";
</script>
<script src="../all.js.min.dir/partner_home.js"></script>

<?php
$success_rate=0;
$stmt_all_refer=mysqli_prepare($con,"SELECT rl.id FROM refer_loan rl INNER JOIN loan_apply_form lf ON lf.id=rl.user_id WHERE rl.partner_id=? AND lf.mobile_confrim=? AND lf.email_confrim=?");
if($stmt_all_refer){
    $status_ver=0;
    mysqli_stmt_bind_param($stmt_all_refer,"iii",$partner_id,$status_ver,$status_ver);
    mysqli_stmt_execute($stmt_all_refer);
    mysqli_stmt_store_result($stmt_all_refer);
    $all_refer=mysqli_stmt_num_rows($stmt_all_refer);
    mysqli_stmt_close($stmt_all_refer);
    if($all_refer>0){
        $status_loan="success";
        $stmt_success_refer=mysqli_prepare($con,"SELECT rl.id FROM refer_loan rl INNER JOIN loan_apply_form lf ON lf.id=rl.user_id WHERE rl.partner_id =? AND lf.status_loan=?");
        if($stmt_success_refer){
            mysqli_stmt_bind_param($stmt_success_refer,"is",$partner_id,$status_loan);
            mysqli_stmt_execute($stmt_success_refer);
            mysqli_stmt_store_result($stmt_success_refer);
            $success_refers=mysqli_stmt_num_rows($stmt_success_refer);
            mysqli_stmt_close($stmt_success_refer);
            if($success_refers>0){
                $success_rate=($success_refers*100)/$all_refer;
            }else{
                $success_rate=0;
            }
        }else{
            header("location:../index.php");
        }
    }else{
        $success_rate=0;
    }
}else{
    header("location:../index.php");
}
?>
<script>
    document.getElementById("res").innerText=Math.floor("<?=$success_rate?>");
</script>

<?php
if(isset($_GET['status']) AND !empty($_GET['status']) AND $_GET['status']=="failed"){
    if(isset($_GET['user_error']) && !empty($_GET['user_error'])){
        $data=xss_val($con,$_GET['user_error']);
    }else{
        $data="Invalid Data";
    }
    ?>
    <script>
        ___error("set","<?=$data?>");
    </script>
<?php
}

?>