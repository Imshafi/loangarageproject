<?php 
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    require_once 'all.min.sub.php.dir/connection.all.min.php';
    require_once 'all.inc.fle.php.dir/al-fun-form-functions.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
?>
        <link rel="stylesheet" href="all.min.style_sheet.dir/find_ifsc.css">
        <title>Find Your IFSC CODE</title>
    </head>
    <body>
        <div class="continer_page">
            <?php 
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
            ?>
            <div class="loader_con">
                <div class="loading">
                </div>
            </div>
            <style>
                .loader_con
                {
                    background-color:rgb(218 218 218 / 0.7);
                    height:calc(100vh - 80px);
                    width:100%;
                    position:absolute;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    z-index:1;
                    display:none;
                }
                .loading
                {
                    height:50px;
                    width:50px;
                    border-top:5px solid #11e311;
                    border-radius:50%;
                    animation:rotate 1s infinite;
                }
            </style>
            <div class="continer_content">
                <div class="heading_ifsc_inner">
                    <h3>Know Your IFSC Code</h3>
                </div>
                <div class="error" id="error_con">
                    Something went wrong
                </div>
                <div class="sub_con">
                    <form id="get_ifsc">
                        <input type="hidden" name="csrf" id="casrf_tkn" value="<?=token('GET_IFSC_CODE')?>">
                        <select name="bank_name" id="inp1" class="inp">
                            <option value="select">Please Select Bank</option>
                            <?php
                                $bank_que=mysqli_query( $con,"SELECT `name` FROM `bank_names` ");
                                if( mysqli_num_rows( $bank_que )>0 )
                                {
                                    while ($data=mysqli_fetch_row( $bank_que )) {
                                        echo "<option value='".xss_val( $con,$data[0] )."'>".xss_val( $con,$data[0] )."</option>";
                                    }
                                }
                                else
                                {
                                    echo "<option value='select'>Data Not found </option>";
                                }
                            ?>
                        </select>
                        <select name="bank_state" id="inp2" class="inp">
                            <option value="select">Please Select State</option>
                        </select>
                        <select name="bank_dis" id="inp3" class="inp">
                            <option value="select">Please Select District</option>
                        </select>
                        <select name="bank_office" id="inp4" class="inp">
                            <option value="select">Please Select Branch</option>
                        </select>
                    </form>
                    <div class="changing">
                        OR
                    </div>
                    <form id="get_details">
                        <input type="text"   name="ifsc_get_user_data" id="ifsc_get_all" placeholder="Enter IFSC Code" style="cursor:default;" class="inp" required autocomplete="off">
                        <input type="submit" value="Get INFO"  class="ifsc_get_all_sub" >
                    </form>
                    <div class="result_con" id="rtn_res_con">
                        <table>
                            <tr>
                                <td class="imp">
                                    <strong>IFSC Code <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_ifsc"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>MICR Code <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_micr"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>Bank <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_bank"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>Address<span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_adr"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>District <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_dis"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>State <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_state"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>Branch <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_branch"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="imp">
                                    <strong>Mobile No <span class="right">:</span></strong>
                                </td>
                                <td>
                                    <span id="res_num"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?php
                require_once 'all.inc.fle.php.dir/footer.full.inc.php';
            ?>
        </div>
        <script src="./all.js.min.dir/find_ifsc.js"></script>
    </body>
</html>