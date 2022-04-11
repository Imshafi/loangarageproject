    <?php 
        require_once 'all.inc.fle.php.dir/inc.fle.php';
        define("A0(57%?<Fr@4**&K#2*&(J^8392$()8347&^",true);
    ?>
        <link rel="stylesheet" href="all.min.style_sheet.dir/index.css">
        <title>Home</title>
    </head>
    <body class="body">
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
                z-index:1;
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
                document.querySelector(".continer_page").style.display="block";

            })
        </script>
        <div class="continer_page">
            <?php 
                require_once 'all.inc.fle.php.dir/nav.bar.full.inc.php';
            ?>
            <div class="continer_content">
                <div class="articles_con">
                    <a href="articles.home.php" class="articles">Knowledge Center</a>
                </div>
                <div class="carousel_continer">
                    <div class="carousel_slide">
                        <input type="radio" name="radio_btn" id="radio_btn1" checked>
                        <input type="radio" name="radio_btn" id="radio_btn2">
                        <input type="radio" name="radio_btn" id="radio_btn3">
                        <input type="radio" name="radio_btn" id="radio_btn4">
                        <input type="radio" name="radio_btn" id="radio_btn5">
                        <input type="radio" name="radio_btn" id="radio_btn6">
                        <input type="radio" name="radio_btn" id="radio_btn7">
                        <input type="radio" name="radio_btn" id="radio_btn8">

                        <div class="slide one_img_con">
                            <img src="web.picture.dir/Personal Loan.jpg" alt="Personal Loan">
                            <div class="loan_info">
                                <h2 class="loan_heading">Personal Loan</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=personal_loan">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide two_img_con">
                            <img src="web.picture.dir/business Loan.jpg" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Business Loan</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=business_loan">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide three_img_con">
                            <img src="web.picture.dir/home Loan.jpg" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Home Loan</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=home_loan">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide four_img_con">
                            <img src="web.picture.dir/Loan Against Property.jpg" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Loan Against Propety</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=loan_adainst_property">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide five_img_con">
                            <img src="web.picture.dir/personal Loan Against Property.jpg" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Personal Loan Balance Transfer</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=personal_loan_bank_transfer">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide six_img_con">
                            <img src="web.picture.dir/home Loan Against Property.png" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Home Loan Balance Transfer</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=home_loan_bank_transfer">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide seven_img_con">
                            <img src="web.picture.dir/Credit Card Balance Transfer.jpg" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Credit Card Balance Transfer</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=credit_card_balance_transfer">Apply Now</a>
                            </div>
                        </div>
                        <div class="slide eight_img_con">
                            <img src="web.picture.dir/Credit Card.png" alt="Image_1">
                            <div class="loan_info">
                                <h2 class="loan_heading">Credit Card</h2>
                                <a class="btn-loan-fir read_more_btn" href="loan_apply.php?status=apply&&data=credit_card">Apply Now</a>
                            </div>
                        </div>
                        <div class="navigation_btn">
                            <div class="auto_btn1"></div>
                            <div class="auto_btn2"></div>
                            <div class="auto_btn3"></div>
                            <div class="auto_btn4"></div>
                            <div class="auto_btn5"></div>
                            <div class="auto_btn6"></div>
                            <div class="auto_btn7"></div>
                            <div class="auto_btn8"></div>
                        </div>
                    </div>
                    <div class="navigation-manual">
                        <label for="radio_btn1" class="manual_btn"></label>
                        <label for="radio_btn2" class="manual_btn"></label>
                        <label for="radio_btn3" class="manual_btn"></label>
                        <label for="radio_btn4" class="manual_btn"></label>
                        <label for="radio_btn5" class="manual_btn"></label>
                        <label for="radio_btn6" class="manual_btn"></label>
                        <label for="radio_btn7" class="manual_btn"></label>
                        <label for="radio_btn8" class="manual_btn"></label>
                    </div>
                </div>
                <div class="content_continer_all">
                    <div class="continer_loan continer_personal" id="personal_loan">
                        <h1>Personal Loan</h1>
                        <div class="content_loan_sub_continer">
                            <img class="content_img" src="web.picture.dir/Personal Loan.jpg" alt="Personal Loan">
                            <div class="text">
                                A Personal Loan is an unsecured loan that we can borrow from a bank or non-banking financial institution if we require funds to fulfil our financial. <br>
                                You borrow a loan when you require money for your personal use. Once you submit your loan application to a lender for a Personal Loan, the lender verifies and approves it. Post this, the loan amount is disbursed into your bank account (preferably Salary Account). Once you receive the loan amount, you will need to repay the lender via EMIs for the loan repayment tenure (preferably through e-NACH). <br>
                                The maximum amount of loan depends on your monthly income Vs your monthly obligation and Credit Bureau Score, In India. <br>
                                The bare minimum salary requirement will vary from lender to lender. Most lenders, however, will require you to earn at least Rs.15,000. <br>
                                Personal Loans offer tax exemptions if you are using the loan amount for renovation of your house or to pay educational expenses. <br>
                            </div>
                        </div>
                        <div class="apply_continer">
                            <a href="loan_apply.php?status=apply&&data=personal_loan">Apply Now</a>
                        </div>
                    </div>
                    <div class="continer_loan continer_Business" id="Business_loan">
                        <h1>Business Loan</h1>
                        <div class="content_loan_sub_continer">
                            <img class="content_img" src="web.picture.dir/business Loan.jpg" alt="Business Loan">
                            <div class="text">
                                Taking a Business Loan is a smart way to arrange funds, during the expansion of an organisation. Business expansion 
                                can include starting launch of a new product or a new department or upgrading an operation or product or stepping 
                                into a new area or market. Additionally, the chances of loan approval for an existing business are usually high owing 
                                to the fact that it holds an existing track record.<br>
                                Most of the time it is difficult for small companies to ensure there is enough amount of cash flow within the 
                                organisation. Therefore, a business might face a shortage of fund to fulfil its liquidity requirements for a working 
                                capital such as utility bills, over-head salary, managing inventory, rent. However, these problems can be solved if a 
                                business owner decides to take a Business Loan towards meeting the company’s temporary financial crisis.<br>
                                When cash flow is on lower side within an organisation due to reasons such as market fluctuation and increase in 
                                operating cost, it is difficult to manage regular expenses such as wages, supplies and raw materials. In order to keep 
                                the business running and to recover from such situation, a businessman might decide to take a Business Loan and 
                                keep the business going on.<br>
                                If you are owning a business that is in demand only during a certain time of the year then it might be difficult for you 
                                to manage the expenses when the orders start rushing in. At that time, you can secure a short-term Business Loan to
                                ensure undisrupted service to your customers and can repay the loan using the profit after the peak season is over.<br>
                            </div>
                        </div>
                        <div class="apply_continer">
                            <a href="loan_apply.php?status=apply&&data=business_loan">Apply Now</a>
                        </div>
                    </div>
                    <div class="continer_loan continer_home" id="home_loan">
                        <h1>Home Loan</h1>
                        <div class="content_loan_sub_continer">
                            <img class="content_img" src="web.picture.dir/home Loan.jpg" alt="Home Loan">
                            <div class="text">
                                A Home Loan is a secured loan that you can take from a bank or any other lending institution at a certain rate of 
                                interest. The lender has all the rights to sale the property as loan recovery in case you fail to repay your dues under 
                                any circumstances. Home Loan repayments are done through EMI or equated monthly interest which depends on 
                                the amount you have borrowed, interest rate, and loan tenure. Most Home Loans are designed for purchasing or 
                                constructing a flat or a house respectively, however there are loans for home renovation and extension as well.<br>
                                Most banks offer loans of up to 85% of the total property cost, however, the final sum offered is solely at the 
                                lender’s discretion and depends on the amount borrowed and certain other parameters.<br>
                                Before signing up for a Home Loan product, it’s suggested that you compare loans offered by different banks and 
                                lending institutions. While comparing, consider the interest rate, Loan-to-Value (LTV) ratio, processing fees, and 
                                tenure offered by the bank. Use our Loan EMI calculator and calculate your EMI based on these factors. <br>
                                Usually, it takes 2 to 4 weeks to get Home Loan sanctioned. However, you need to keep a few factors in mind for a 
                                better understanding. Firstly, you need a pre-approval of your Home Loan from the concerned bank or lender to get 
                                your loan sanctioned. Also, pre-approval doesn’t always mean that your loan will be disbursed immediately and 
                                depends on certain factors. For example, your loan sanction can be delayed if there is a delay in submission of 
                                property or income-related documents<br>
                                Banks/financial institutions consider the following factors when determining your loan eligibility :<br>
                                <ul class="home_loan_items">
                                    <li class="home_loan_item">Age</li>
                                    <li class="home_loan_item">Annual Income</li>
                                    <li class="home_loan_item">Occupational stability</li>
                                    <li class="home_loan_item">Resident type [Indian Citizen, Non-Resident Indian (NRI), Person of Indian Origin (PIO)]</li>
                                    <li class="home_loan_item">Number of co-applicants</li>
                                    <li class="home_loan_item">Co-applicants' income</li>
                                    <li class="home_loan_item">Credit score</li>
                                    <li class="home_loan_item">Other ongoing loans, if any.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="apply_continer">
                            <a href="loan_apply.php?status=apply&&data=home_loan">Apply Now</a>
                        </div>
                    </div>
                    <div class="continer_loan continer_loan_against" id="personal_loan">
                        <h1>Loan Against Property</h1>
                        <div class="content_loan_sub_continer">
                            <img class="content_img" src="web.picture.dir/Loan Against Property.jpg" alt="Loan Against Property">
                            <div class="text">
                                Loan against property is a secured loan that a bank or financial institution provide against fully constructed, freehold 
                                residential and commercial properties. A mortgage loan can be availed for Personal and Business Needs. Existing 
                                Loan Against Property from one bank or financial institution can also be transferred to other one.<br>
                                For Existing Customers, the principal outstanding on all existing loans and the Loan Against Property being availed 
                                should not cumulatively exceed 60% of the Market Value of the mortgaged property as assessed by any financial 
                                institution. For New Customers, loan against property being availed should not, generally, exceed 50% of the Market 
                                Value of the property, as assessed by any financial institution.<br>
                                Loan Against Property (LAP) can be availed by both salaried and self-employed individuals for personal and 
                                professional needs, other than purposes like marriage, Child's education, business expansion, debt consolidation etc.<br>
                                Security of the loan would generally be security interest on the property being financed by us and / or any other 
                                collateral / interim security as may be required by a bank or financial institute<br>
                            </div>
                        </div>
                        <div class="apply_continer">
                            <a href="loan_apply.php?status=apply&&data=loan_adainst_property">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                require_once 'all.inc.fle.php.dir/footer.full.inc.php';
            ?>
        </div>
    </body>
    <script src="all.js.min.dir/index.js"></script>
</html>