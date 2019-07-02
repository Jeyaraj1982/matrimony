<?php
    $page="MyWallet";
    $spage="RefillWallet";
?>
<script>
$(document).ready(function () {
   $("#Amount").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#ErrAmount").html("Digits Only").fadeIn().fadeIn("fast");
               return false;
    }
   });
   $("#Amount").blur(function () {
    
        IsNonEmpty("Amount","ErrAmount","Please Enter Amount");
                        
   });
   $("#check").blur(function () {
    
        IsNonEmpty("check","Errcheck","If yo agree terms and conditions please select");
                        
   });
   });
function submitamount() {
    $('#ErrAmount').html("");
    if(IsNonEmpty("Amount","ErrAmount","Please Enter Amount")){
        
        if (!( parseInt($('#Amount').val())>=500 && parseInt($('#Amount').val())<=10000))    {
            $("#ErrAmount").html("Please enter above 500 and below 10000") ;
        }
        
        if (!( parseInt($('#Amount').val() % 100)==0))    {
            $("#ErrAmount").html("Please enter only multiples of 100") ;
        }
    }
    if(document.form1.check.checked == false){
    document.getElementById("Errcheck").innerHTML="if yo agree terms and conditions please select!";
    return false;
    }              
}
</script>
<?php include_once("accounts_header.php");?>
<form method="post" action="" name="form1">
    <div class="col-sm-9" style="margin-top: -8px;color:#444">
        <h4 class="card-title" style="margin-bottom:5px">Refill Wallet Using Paypal</h4>
        <span style="color:#999;">It's is safe transaction and gives refill amount instantly.</span> <br><br>
        Refill Amount: (₹)<br> 
        <input type="text" placeholder="Enter Amount" name="Amount" id="Amount" style="border:1px solid #ccc;padding:3px;padding-left:10px;"> <br>
        <span style="color:#999;font-size:11px;">Multiples of 100 and Minimum ₹ 500 & Maximum ₹ 10000</span><br>
        <span class="errorstring" id="ErrAmount"><?php echo isset($ErrAmount) ? $ErrAmount : "";?></span><br><br><br>
         <input type="checkbox" name="check" id="check">&nbsp;<label for="check">I understand terms of wallet udpate </label><a href="">Lean more</a><Br>
         <span class="errorstring" id="Errcheck"><?php echo isset($Errcheck) ? $Errcheck : "";?></span><br>
        <div><img src="<?php echo ImageUrl;?>paypal_checkout.png" onclick="submitamount()" style="height:36px;cursor:pointer">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://nahami.online/sl/Dashboard/MyAccounts/RefillBank" data-toggle="modal" data-target="#termscondition"  style="color:#2f5bc4">Continue Bank Transfer</a><br>  
        </div>
        <!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="mmminfoshelp@gmail.com">
        <input type="hidden" name="item_name" value="Donation">
        <input type="hidden" name="amount" value="">
        <select name="currency_code" style="padding:4px 10px">
            <option value="USD">USD
            </option><option value="INR">INR
        </option></select><br><br>
        <input type="hidden" name="undefined_quantity" value="1">
        <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynowCC_LG.gif" name="submit" border="0">
    </form> -->
    
    <bR><br>
    <bR><br>
    <bR><br>
 
    <div style="text-align:right"><img src="<?php echo ImageUrl;?>paypal_lic.png"></div>
    </div>
    <div class="modal" id="termscondition" role="dialog"  style="padding-top:177px;padding-right:0px;background:rgba(9, 9, 9, 0.13) none repeat scroll 0% 0%;">
    <div class="modal-dialog" style="width: 367px;">
        <div class="modal-content">
            <div class="modal-body" style="padding:20px">
                    <div  style="height: 315px;">
                    <h5 style="text-align:center">Refill Wallet Terms</h5>
                   Are you sure want to delete?
                  I. Indian Nationals & Citizens.  <br>
                   II. Persons of Indian Origin (PIO). <br>
                   III. Non Resident Indians (NRI). <br>
                   IV. Persons of Indian Descent or Indian Heritage  <br>
                   V. Not prohibited or prevented by any applicable law for the time being in force from entering into a valid marriage.<br>
                   VI.Sharing of confidential and personal data with each other but not limited to sharing of bank details, etc. <br>
                    <button type="button" class="btn btn-prinary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>                
<?php include_once("accounts_footer.php");?>                     