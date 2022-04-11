<?php 
    require_once 'all.inc.fle.php.dir/inc.fle.php';
    define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
?>
        <link rel="stylesheet" href="all.min.style_sheet.dir/emicalc.css">
        <title>Emi Calculator</title>
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
                z-index:3;
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
        <div class="continer_page">
            <?php 
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
            ?>
            <div class="continer_content">
                <div class="sub_continer">
                    <div class="continer_headding">
                        <h2 class="headding_calc">EMI Calculator For Loans</h2>
                    </div>
                    <div class="user_inp_con">
                        <div class="fixed_con_input">
                            <div class="input_key_con con_inps">
                                <span class="heading_inp">Loan Amount</span>
                                <div class="handler in">
                                    <input class="inp inp_amt" type="number" id="user_inp_amount">
                                    <span class="amount_txt show_type">&#8377</span>
                                </div>
                            </div>
                            <div class="range_continer">
                                <div class="range_slider_label">
                                    <span class="fnt" id="amt_label">100</span>
                                </div>
                                <div class="range_inp_con">
                                    <div class="value left fnt">0 Lakhs</div>
                                    <input type="range" id="range_amt" min="0" max="200" value="100">
                                    <div class="value right fnt">200 Lakhs</div>
                                </div>
                            </div>
                        </div>
                        <div class="fixed_con_input">
                            <div class="input_key_con con_inps">
                                <span class="heading_inp">Interest Rate</span>
                                <div class="handler in">
                                    <input class="inp inp_int" type="number" id="user_inp_interest">
                                    <span class="amount_txt show_type">%</span>
                                </div>
                            </div>
                            <div class="range_continer">
                                <div class="range_slider_label">
                                    <span class="fnt" id="interest_label">10%</span>
                                </div>
                                <div class="range_inp_con">
                                    <div class="value left fnt">0%</div>
                                    <input type="range" id="range_int" min="0" max="20" value="10">
                                    <div class="value right fnt">20%</div>
                                </div>
                            </div>
                        </div>
                        <div class="fixed_con_input">
                            <div class="input_key_con con_inps">
                                <span class="heading_inp">Loan Tenure</span>
                                <div class="handler in">
                                    <input class="inp inp_amt" type="number" id="user_inp_time_yr">
                                    <span class="amount_txt show_type">Yr</span>
                                </div>
                            </div>
                            <div class="range_continer">
                                <div class="range_slider_label">
                                    <span class="fnt" id="time_yr_label">25</span>
                                </div>
                                <div class="range_inp_con">
                                    <div class="value left fnt">0 Years</div>
                                    <input type="range" id="range_time_yr" min="0" max="50" value="25">
                                    <div class="value right fnt">50 Years</div>
                                </div>
                            </div>
                        </div>
                        <div class="user_result">
                            <div class="result_show_con">
                                <div class="result_sub_continer">
                                    <div class="totalAmount">
                                        <div class="main_continet" id="total_emi">
                                        &#8377; 90870
                                        </div>
                                        <div class="label_content">
                                            <span class="label_show">Total EMI</span>
                                        </div>
                                    </div>
                                    <div class="totalAmount center">
                                        <div class="main_continet" id="total_int">
                                            &#8377; 17261022
                                        </div>
                                        <div class="label_content">
                                            <span class="label_show">Total Interest Payable</span>
                                        </div>
                                    </div>
                                    <div class="totalAmount last_ch">
                                        <div class="main_continet" id="total_amt">
                                            &#8377; 27261022
                                        </div>
                                        <div class="label_content">
                                            <span class="label_show">Total Amount</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                require_once 'all.inc.fle.php.dir/footer.full.inc.php';
            ?>
        </div>
        <script src="./all.js.min.dir/emi_calc.js"></script>
    </body>
</html>