<?php
define("A0(57%?<Fr@4**&__Admin___K#2*&(J^8392$()8347&^",true);
require_once 'all.inc.nav.php';
?>
<style>
    .loading_con
    {
        text-align:center;
        margin:10px 0px;
    }
</style>
        <link rel="stylesheet" href="../all.min.style_sheet.dir/partner_home.css">
        <div class="allContner">
            <div class="error_continer" id="error_continer">
                <span class="error_msg" id="error_msg">Error</span>
            </div>
            <div class="main_head_con main_filter_approval">
                <div class="myactv myper">Loan Applications</div>
                <div class="name_refer filter_con">
                    <input type="date" name="date_one" id="date_one">
                    <span class="to">to</span>
                    <input type="date" name="date_two" id="date_two">
                    <button calss="filter_btn" id="filter_get_data">Filter</button>
                    <div class="date_error" id="date_error">Select Date</div>
                </div>
            </div>
            <div class="table_con">
                <div class="loading_con">
                    
                </div>
                <table class="reffer_table" border="1">
                    <thead  cell-padding="10">
                        <tr class="tr_head">
                            <th>S.No</th>
                            <th>Name</th>
                            <th class="res_val">Response</th>
                            <th>Loan Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody  id="table_activity_partner">
                    </tbody>
                </table>
            </div>
        </div>
        <script src="admin.js.all.files/admin_home.js"></script>
    </body>
</html>