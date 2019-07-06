<?php
    $page="MyWallet";
    $spage="RefillWallet";
?>
    <script>
        $(document).ready(function() {
            $("#Amount").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    $("#ErrAmount").html("Digits Only").fadeIn().fadeIn("fast");
                    return false;
                }
            });
            $("#Amount").blur(function() {
                IsNonEmpty("Amount", "ErrAmount", "Please Enter Amount");
            });
            $("#check").blur(function() {
                IsNonEmpty("check", "Errcheck", "If yo agree terms and conditions please select");
            });
        });

        function submitamount() {

            $('#ErrAmount').html("");
            $('#Errcheck').html("");
            $('#ErrTxnDate').html("");
            $('#ErrTxnId').html("");
            
           IsNonEmpty("TxnDate","ErrTxnDate","Please Enter Transaction Date");
           if(IsNonEmpty("TxnId","ErrTxnId","Please Enter Transaction ID")){
               IsAlphaNumeric("TxnId","ErrTxnId","Please Enter Alpha Numeric characters only")
           }

            if (IsNonEmpty("Amount", "ErrAmount", "Please Enter Amount")) {

                if (!(parseInt($('#Amount').val()) >= 500 && parseInt($('#Amount').val()) <= 10000)) {
                    $("#ErrAmount").html("Please enter above 500 and below 10000");
                    return false;
                }

                if (!(parseInt($('#Amount').val() % 100) == 0)) {
                    $("#ErrAmount").html("Please enter only multiples of 100");
                    return false;
                }
            }
            if (document.form1.check.checked == false) {
                $("#Errcheck").html("if yo agree terms and conditions please select!");
                return false;
            }
            $('#form1').submit();
        }
    </script>
    <?php 
     $response = $webservice->getData("Member","GetBankNames");
            $BankNames = $response['data']['BankName'] ;
            $Modes = $response['data']['Mode'] ;

?>
        <?php include_once("accounts_header.php");?>
            <form method="post" action="">
                <div class="col-sm-9" style="margin-top: -8px;">
                    <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Using Bank</h4>
                    <span style="color:#999;">It's is safe transaction and gives refill amount.</span>
                    <br>
                    <br> Bank To
                    <br>
                    <select id="BankName" name="BankName" style="border: 1px solid #ccc;padding: 3px;padding-left: 3px;padding-left: 10px;width: 184px;">
                        <?php foreach($BankNames as $BankName) { ?>
                            <option value="<?php echo $BankName['BankName'];?>" <?php echo ($_POST[ 'BankName']==$BankName[ 'BankName']) ? " selected='selected' " : "";?>>
                                <?php echo $BankName['BankName'];?>
                            </option>
                            <?php } ?>
                    </select>
                    <span class="errorstring" id="ErrBankName"><?php echo isset($ErrBankName)? $ErrBankName : "";?></span>  <br>
                    <br> Refill Amount: (₹)
                    <br>
                    <input type="text" placeholder="Enter Amount" name="Amount" id="Amount" style="border:1px solid #ccc;padding:3px;padding-left:10px;">
                    <br>
                    <span style="color:#999;font-size:11px;">Multiples of 100 and Minimum ₹ 500 & Maximum ₹ 10000</span>
                    <br>
                    <span class="errorstring" id="ErrAmount"></span>
                    <br> Transaction Date :
                    <br>
                    <input type="date" name="TxnDate" id="TxnDate" style="border:1px solid #ccc;padding:3px;padding-left:10px;width: 185px;">
                    <br>
                    <span class="errorstring" id="ErrTxnDate"></span>
                    <br> Mode
                    <br>
                    <select id="Mode" name="Mode" style="border: 1px solid #ccc;padding: 3px;padding-left: 3px;padding-left: 10px;width: 184px;">
                        <?php foreach($Modes as $Mode) { ?>
                            <option value="<?php echo $Mode['CodeValue'];?>" <?php echo ($_POST[ 'MODE']==$Mode[ 'CodeValue']) ? " selected='selected' " : "";?>>
                                <?php echo $Mode['CodeValue'];?>
                            </option>
                            <?php } ?>
                    </select>
                    <span class="errorstring" id="ErrMode"><?php echo isset($ErrMode)? $ErrMode : "";?></span><br>
                    <br> Transaction ID :
                    <br>
                    <input type="text" name="TxnId" id="TxnId" style="border:1px solid #ccc;padding:3px;padding-left:10px;">
                    <br>
                    <span class="errorstring" id="ErrTxnId"></span>
                    <br>
                    <input type="checkbox" name="check" id="check">&nbsp;
                    <label for="check" style="font-weight:normal">I understand terms of wallet udpate </label>&nbsp;&nbsp;<a href="">Lean more</a>
                    <Br>
                    <span class="errorstring" id="Errcheck"></span>
                    <br>
                    <div>
                        <a class="btn btn-primary" onclick="submitamount()" style="height:36px;color:white;cursor:pointer;font-family:roboto">Submit</a> 
                    </div>
                </div>
            </form>
            <?php include_once("accounts_footer.php");?>